<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\LocationEvent;
use weixin\base\Weixin;
use weixin\messages\response\TextMsg;
use weixin\responding\Responsor;

/**
 * Class LocationEventHandler 位置上报事件消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class LocationEventHandler extends Component implements MessageHandler
{
    /**
     * @param LocationEvent $LocationEvent 地理位置上报事件消息
     * @return TextMsg
     */
    public function handle($LocationEvent)
    {
        $msg = '';
        if(Weixin::app($this)->isDebug()){
            $msg = new TextMsg($LocationEvent);
            $content = "消息属性：\n";
            foreach($LocationEvent as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}