<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\ViewEvent;
use weixin\Weixin;
use weixin\messages\response\TextMsg;

/**
 * Class ViewEventHandler 点击菜单跳转链接事件消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class ViewEventHandler extends Component implements MessageHandler
{
    /**
     * @param ViewEvent $ViewEvent 点击菜单跳转链接事件消息
     * @return TextMsg
     */
    public function handle($ViewEvent)
    {
        $msg = '';
        if(Weixin::app($this)->isDebug()){
            $msg = new TextMsg($ViewEvent);
            $content = "消息属性：\n";
            foreach($ViewEvent as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}