<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\api\js;

use weixin\api\js\models\JsapiTicket;
use weixin\api\Request;
use weixin\Weixin;

/**
 * Class JsAPI
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class JsAPI extends Request
{
    /**
     * @param string $accessToken
     * @return JsapiTicket
     * @throws \weixin\base\Exception
     */
    public function getJsapiTicket($accessToken)
    {
        $data = $this->get('https://api.weixin.qq.com/cgi-bin/ticket/getticket', [
            'access_token' => $accessToken,
            'type' => 'jsapi'
        ]);
        echo $this->curl->url;

        return (new JsapiTicket())->load($data);
    }
}