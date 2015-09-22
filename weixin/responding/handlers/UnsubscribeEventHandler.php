<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\UnsubscribeEvent;
use weixin\Weixin;
use weixin\messages\response\TextMsg;

/**
 * Class UnsubscribeEventHandler 取消关注消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class UnsubscribeEventHandler extends Component implements MessageHandler
{
    /**
     * @param UnsubscribeEvent $UnsubscribeEvent 取消关注事件消息
     * @return TextMsg
     */
    public function handle($UnsubscribeEvent)
    {
        $msg = '';
        if(Weixin::app($this)->isDebug()){
            $msg = new TextMsg($UnsubscribeEvent);
            $content = "消息属性：\n";
            foreach($UnsubscribeEvent as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}