<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\Location;
use weixin\Weixin;
use weixin\messages\response\TextMsg;

/**
 * Class LocationHandler 位置消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class LocationHandler extends Component implements MessageHandler
{
    /**
     * @param Location $Location 地理位置消息
     * @return TextMsg
     */
    public function handle($Location)
    {
        $msg = '';
        if(Weixin::app($this)->isDebug()){
            $msg = new TextMsg($Location);
            $content = "消息属性：\n";
            foreach($Location as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}