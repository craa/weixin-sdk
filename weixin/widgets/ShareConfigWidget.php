<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\widgets;

use weixin\base\Account;
use weixin\base\Exception;
use weixin\helpers\SignHelper;
use weixin\helpers\StringHelper;
use weixin\responding\Request;

/**
 * Class ShareWidget
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class ShareConfigWidget extends Widget
{
    /**
     * @var \weixin\base\Account
     */
    public $account;
    public $debug = false;
    public $jsApiList = [
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone',
        'startRecord',
        'stopRecord',
        'onVoiceRecordEnd',
        'playVoice',
        'pauseVoice',
        'stopVoice',
        'onVoicePlayEnd',
        'uploadVoice',
        'downloadVoice',
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'translateVoice',
        'getNetworkType',
        'openLocation',
        'getLocation',
        'hideOptionMenu',
        'showOptionMenu',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'closeWindow',
        'scanQRCode',
        'chooseWXPay',
        'openProductSpecificView',
        'addCard',
        'chooseCard',
        'openCard',
    ];
    public $url;

    private $_params = [];

    public function init()
    {
        if (is_null($this->url))
            $this->url = (new Request())->getAbsoluteUrl();
        if (is_null($this->account) || !$this->account instanceof Account) {
            throw new Exception('account must instance of Class \weixin\base\Account');
        }

        $timestamp = time();
        $nonceStr = StringHelper::random();
        $signature = SignHelper::wxSign([
            'jsapi_ticket' => $this->account->getJsapiTicket(),
            'noncestr' => $nonceStr,
            'timestamp' => $timestamp,
            'url' => $this->url,
        ]);

        $this->_params = [
            'debug' => $this->debug,
            'appId' => $this->account->appid,
            'timestamp' => $timestamp,
            'nonceStr' => $nonceStr,
            'signature' => $signature,
            'jsApiList' => $this->jsApiList,
        ];
    }

    public function run()
    {
        return $this->render('share_config', ['config' => json_encode($this->_params)]);
    }

}