<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\api\common;

use weixin\api\common\models\AccessToken;
use weixin\api\common\models\IPList;
use weixin\api\Request;
use weixin\Weixin;

/**
 * Class CommonAPI 微信公共接口
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class CommonAPI extends Request
{
    /**
     * @return AccessToken
     * @throws \weixin\base\Exception
     */
    public function getAccessToken()
    {
        $data = $this->get('https://api.weixin.qq.com/cgi-bin/token',[
            'grant_type' => 'client_credential',
            'appid' => Weixin::app($this)->getAccount()->appid,
            'secret' => Weixin::app($this)->getAccount()->appsecret
        ]);

        return (new AccessToken())->load($data);
    }

    public function getIpList($accessToken)
    {
        $data = $this->get('https://api.weixin.qq.com/cgi-bin/getcallbackip',[
            'access_token' => $accessToken,
        ]);
        return (new IPList())->load($data);
    }
}