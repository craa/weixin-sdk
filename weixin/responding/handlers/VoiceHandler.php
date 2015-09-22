<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\Voice;
use weixin\Weixin;
use weixin\messages\response\TextMsg;

/**
 * Class VoiceHandler 语音消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class VoiceHandler extends Component implements MessageHandler
{
    /**
     * @param Voice $Voice 语音消息
     * @return TextMsg
     */
    public function handle($Voice)
    {
        $msg = '';
        if(Weixin::app($this)->isDebug()){
            $msg = new TextMsg($Voice);
            $content = "消息属性：\n";
            foreach($Voice as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}