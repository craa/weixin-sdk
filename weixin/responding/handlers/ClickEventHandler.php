<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\response\BaseMessage;
use weixin\messages\response\TextMsg;
use weixin\Weixin;
use weixin\messages\request\ClickEvent;

/**
 * Class ClickEventHandler 点击事件消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class ClickEventHandler extends Component implements MessageHandler
{
    /**
     * @param ClickEvent $ClickEvent
     * @return BaseMessage
     */
    public function handle($ClickEvent)
    {
        $msg = '';
        if(Weixin::app($this)->isDebug()){
            $msg = new TextMsg($ClickEvent);
            $content = "消息属性：\n";
            foreach($ClickEvent as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}