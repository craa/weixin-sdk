<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\Video;
use weixin\base\Weixin;
use weixin\messages\response\TextMsg;
use weixin\responding\Responsor;

/**
 * Class VideoHandler 视频消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class VideoHandler extends Component implements MessageHandler
{
    /**
     * @param Video $Video 视频消息
     * @return TextMsg
     */
    public function handle($Video)
    {
        $msg = '';
        if(Weixin::app($this)->isDebug()){
            $msg = new TextMsg($Video);
            $content = "消息属性：\n";
            foreach($Video as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}