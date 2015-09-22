<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding;

use weixin\base\Component;
use weixin\base\Exception;
use weixin\Weixin;
use weixin\messages\response\BaseMessage;
use weixin\responding\encryption\ErrorCode;

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
        if(Weixin::app($this)->getResponsor()->getRequest()->isEncryptMsg()){
            $status = Weixin::app($this)->getResponsor()->getMessageEncryptor()->encryptMsg($res, time(), rand(1000, 9999), $res);
            if($status != ErrorCode::$OK){
                throw new Exception('Encrypt message error', $status);
            }
        }
        echo $res;
    }

    public function header()
    {
        header('Content-Type: text/xml; Charset=utf-8');
    }
}