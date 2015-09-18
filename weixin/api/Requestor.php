<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\api;

use weixin\base\Application;
use weixin\base\Curl;
use weixin\base\Exception;

/**
 * Class Requestor API请求器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Requestor extends Curl
{
    /**
     * Get
     *
     * @access public
     * @param  $url
     * @param  $data
     *
     * @return string
     */
    public function get($url, $data = [])
    {
        $response = parent::get($url, $data);
        if(isset($response['errcode'])){
            $this->handleAPIError($response);
        }

        return $response;
    }

    /**
     * Post
     *
     * @access public
     * @param  $url
     * @param  $data
     *
     * @return string
     */
    public function post($url, $data = [])
    {
        $response = parent::post($url, $data);
        if(isset($response['errcode'])){
            $this->handleAPIError($response);
        }

        return $response;
    }

    /**
     * 处理微信API错误
     * @param $error
     * @throws Exception
     */
    public function handleAPIError($error)
    {
        throw new Exception($error['errmsg'], $error['errcode']);
    }
}