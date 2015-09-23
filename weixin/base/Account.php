<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\base;
use weixin\helpers\CacheHelper;
use weixin\Weixin;

/**
 * Class Account 公众账号组件
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Account extends Component
{
    public $token = 'weixin';
    public $appid;
    public $appsecret;
    /**
     * @var string 公众平台上，开发者设置的EncodingAESKey，当encryptType为2时生效
     */
    public $encodingAesKey;

    /**
     * @var string(32) 商户号
     */
    public $mch_id = '';
    /**
     * @var string(32) 子商户号，受理模式必填
     */
    public $sub_mch_id = '';
    /**
     * @var string(32) 提供方名称
     */
    public $nick_name = '';
    /**
     * @var string(32) 商户名称
     */
    public $send_name = '';
    /**
     * @var string 商户支付密钥
     */
    public $pay_sign_key = '';

    public function getToken()
    {
        return $this->token;
    }

    public function getCache()
    {
        return Weixin::app($this)->getCache();
    }

    /**
     * 获取access_token
     * @param bool $refresh
     * @return string
     * @throws Exception
     */
    public function getAccessToken($refresh = false)
    {
        $key = 'weixin_accesstoken_'.$this->appid;
        $accessToken = CacheHelper::cache($this->getCache(), $key, function(){
            return Weixin::app($this)->getApiRequestor()->getCommonAPI()->getAccessToken()->getAccess_Token();
        }, $refresh);

        return $accessToken;
    }

    /**
     * 获取jsapi_ticket
     * @param bool $refresh
     * @return string
     * @throws Exception
     */
    public function getJsapiTicket($refresh = false)
    {
        $key = 'weixin_js_api_ticket_'.$this->appid;
        $ticket = CacheHelper::cache($this->getCache(), $key, function(){
            return Weixin::app($this)->getApiRequestor()->getJsAPI()->getJsapiTicket($this->getAccessToken())->getTicket();
        }, $refresh);

        return $ticket;
    }
}