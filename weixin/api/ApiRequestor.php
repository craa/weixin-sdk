<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\api;

use weixin\base\Application;
use weixin\api\common\CommonAPI;
use weixin\base\Curl;

/**
 * Class ApiRequestor API请求应用
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class ApiRequestor extends Application
{
    public $curl = 'curl';

    /**
     * @return Curl
     * @throws \weixin\base\Exception
     */
    public function getCurl()
    {
        return $this->get($this->curl);
    }

    /**
     * @return CommonAPI
     * @throws \weixin\base\Exception
     */
    public function getCommonAPI()
    {
        return $this->get('commonAPI');
    }

    public function coreComponents()
    {
        return [
            'curl' => ['class' => 'weixin\base\Curl'],
            'commonAPI' => ['class' => 'weixin\api\common\CommonAPI'],
        ];
    }
}