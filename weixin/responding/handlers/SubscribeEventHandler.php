<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\SubscribeEvent;
use weixin\base\Weixin;
use weixin\messages\response\TextMsg;
use weixin\responding\Responsor;

/**
 * Class SubscribeEventHandler 关注事件消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class SubscribeEventHandler extends Component implements MessageHandler
{
    /**
     * @param Responsor $responsor 响应器
     * @param SubscribeEvent $SubscribeEvent 关注事件消息
     */
    public function handle($responsor, $SubscribeEvent)
    {
        $msg = '';
        if($responsor->isDebug()){
            $msg = new TextMsg($SubscribeEvent);
            $content = "消息属性：\n";
            foreach($SubscribeEvent as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}