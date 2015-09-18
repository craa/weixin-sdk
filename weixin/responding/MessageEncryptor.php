<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding;

use weixin\base\Component;
use weixin\base\Exception;
use weixin\responding\encryption\ErrorCode;
use weixin\responding\encryption\Prpcrypt;
use weixin\responding\encryption\SHA1;
use weixin\responding\encryption\XMLParse;
use weixin\Weixin;

/**
 * Class MessageEncryptor 微信消息加解密组件
 *
 * 该组件需要mcrypt版本>=2.4.0
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class MessageEncryptor extends Component
{
    private $token;
    private $encodingAesKey;
    private $appId;

    public function __construct($config = [])
    {
        if (!extension_loaded('mcrypt')) {
            throw new Exception('Component MessageEncryptor need mcrypt>=2.4.0');
        }

        parent::__construct($config);
        $this->token = Weixin::app($this)->getAccount()->getToken();
        $this->appId = Weixin::app($this)->getAccount()->appid;
        $this->encodingAesKey = Weixin::app($this)->getAccount()->encodingAesKey;
    }

    /**
     * 将公众平台回复用户的消息加密打包.
     * <ol>
     *    <li>对要发送的消息进行AES-CBC加密</li>
     *    <li>生成安全签名</li>
     *    <li>将消息密文和安全签名打包成xml格式</li>
     * </ol>
     *
     * @param $replyMsg string 公众平台待回复用户的消息，xml格式的字符串
     * @param $timeStamp string 时间戳，可以自己生成，也可以用URL参数的timestamp
     * @param $nonce string 随机串，可以自己生成，也可以用URL参数的nonce
     * @param &$encryptMsg string 加密后的可以直接回复用户的密文，包括msg_signature, timestamp, nonce, encrypt的xml格式的字符串,
     *                      当return返回0时有效
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function encryptMsg($replyMsg, $timeStamp, $nonce, &$encryptMsg)
    {
        if (strlen($this->encodingAesKey) != 43) {
            return ErrorCode::$IllegalAesKey;
        }

        $pc = new Prpcrypt($this->encodingAesKey);

        //加密
        $array = $pc->encrypt($replyMsg, $this->appId);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }

        if ($timeStamp == null) {
            $timeStamp = time();
        }
        $encrypt = $array[1];

        //生成安全签名
        $sha1 = new SHA1();
        $array = $sha1->getSHA1($this->token, $timeStamp, $nonce, $encrypt);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }
        $signature = $array[1];

        //生成发送的xml
        $xmlparse = new XMLParse();
        $encryptMsg = $xmlparse->generate($encrypt, $signature, $timeStamp, $nonce);
        return ErrorCode::$OK;
    }


    /**
     * 检验消息的真实性，并且获取解密后的明文.
     * <ol>
     *    <li>利用收到的密文生成安全签名，进行签名验证</li>
     *    <li>若验证通过，则提取xml中的加密消息</li>
     *    <li>对消息进行解密</li>
     * </ol>
     *
     * @param $msgSignature string 签名串，对应URL参数的msg_signature
     * @param $timestamp string 时间戳 对应URL参数的timestamp
     * @param $nonce string 随机串，对应URL参数的nonce
     * @param $postData string 密文，对应POST请求的数据
     * @param &$msg string 解密后的原文，当return返回0时有效
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function decryptMsg($msgSignature, $timestamp = null, $nonce, $postData, &$msg)
    {
        if (strlen($this->encodingAesKey) != 43) {
            return ErrorCode::$IllegalAesKey;
        }

        $pc = new Prpcrypt($this->encodingAesKey);

        //提取密文
        $xmlparse = new XMLParse;
        $array = $xmlparse->extract($postData);
        $ret = $array[0];

        if ($ret != 0) {
            return $ret;
        }

        if ($timestamp == null) {
            $timestamp = time();
        }

        $encrypt = $array[1];
        $touser_name = $array[2];

        //验证安全签名
        $sha1 = new SHA1;
        $array = $sha1->getSHA1($this->token, $timestamp, $nonce, $encrypt);
        $ret = $array[0];

        if ($ret != 0) {
            return $ret;
        }

        $signature = $array[1];
        if ($signature != $msgSignature) {
            return ErrorCode::$ValidateSignatureError;
        }

        $result = $pc->decrypt($encrypt, $this->appId);
        if ($result[0] != 0) {
            return $result[0];
        }
        $msg = $result[1];

        return ErrorCode::$OK;
    }
}