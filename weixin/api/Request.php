<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\api;

use weixin\base\Component;
use weixin\base\Curl;
use weixin\base\Exception;
use weixin\Weixin;

/**
 * Class Request API请求器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Request extends Component
{
    /**
     * @var Curl
     */
    public $curl;

    public function init()
    {
        parent::init();
        $this->curl = Weixin::app($this)->getApiRequestor()->getCurl();
    }

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
        $response = $this->curl->get($url, $data);
        if(isset($response['errcode']) && $response['errcode']!==0){
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
        $response = $this->curlpost($url, $data);
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