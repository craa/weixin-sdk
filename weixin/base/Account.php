<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\base;

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
     * @var string 缓存组件
     */
    public $cache = 'cache';
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
    /**
     * @var string(512) 公众号的全局唯一票据, 有效期7200秒
     */
    private $access_token;
    /**
     * @var string 公众号用于调用微信JS接口的临时票据，有效期7200秒
     */
    private $jsapi_ticket;

    public function getToken()
    {
        return $this->token;
    }

    public function getCache()
    {

    }

    /**
     * 获取access_token
     * @param bool $refresh
     * @return bool
     * @throws Exception
     */
    public function getAccessToken($refresh = false)
    {

    }

    /**
     * 获取jsapi_ticket
     * @param bool $refresh
     * @return bool
     * @throws Exception
     */
    public function getJsapiTicket($refresh = false)
    {

    }
}