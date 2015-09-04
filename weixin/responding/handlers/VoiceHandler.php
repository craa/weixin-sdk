<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\Voice;
use weixin\base\Weixin;
use weixin\messages\response\TextMsg;
use weixin\responding\Responsor;

/**
 * Class VoiceHandler 语音消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class VoiceHandler extends Component implements MessageHandler
{
    /**
     * @param Responsor $responsor 响应器
     * @param Voice $Voice 语音消息
     */
    public function handle($responsor, $Voice)
    {
        $msg = '';
        if($responsor->isDebug()){
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