<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding;

use weixin\base\Component;
use weixin\base\Exception;
use weixin\messages\response\BaseMessage;

/**
 * Class Response 响应模型
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Response extends Component
{
    public $data;

    public function send()
    {
        if(is_string($this->data)){
            $res = $this->data;
        }elseif($this->data instanceof BaseMessage){
            $res = $this->data->toXML();
        }else{
            throw new Exception('unsupported format to response to weixin');
        }

        $this->header();
        echo $res;
    }

    public function header()
    {
        header('Content-Type: text/xml; Charset=utf-8');
    }
}