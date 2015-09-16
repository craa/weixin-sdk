<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\ScanEvent;
use weixin\base\Weixin;
use weixin\messages\response\TextMsg;
use weixin\responding\Responsor;

/**
 * Class ScanEventHandler 扫描带参数二维码事件消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class ScanEventHandler extends Component implements MessageHandler
{
    /**
     * @param ScanEvent $ScanEvent 扫描带参数二维码消息
     * @return TextMsg
     */
    public function handle($ScanEvent)
    {
        $msg = '';
        if(Weixin::app($this)->isDebug()){
            $msg = new TextMsg($ScanEvent);
            $content = "消息属性：\n";
            foreach($ScanEvent as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}