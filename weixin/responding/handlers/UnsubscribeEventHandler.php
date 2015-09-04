<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\UnsubscribeEvent;
use weixin\base\Weixin;
use weixin\messages\response\TextMsg;
use weixin\responding\Responsor;

/**
 * Class UnsubscribeEventHandler 取消关注消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class UnsubscribeEventHandler extends Component implements MessageHandler
{
    /**
     * @param Responsor $responsor 响应器
     * @param UnsubscribeEvent $UnsubscribeEvent 取消关注事件消息
     */
    public function handle($responsor, $UnsubscribeEvent)
    {
        $msg = '';
        if($responsor->isDebug()){
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