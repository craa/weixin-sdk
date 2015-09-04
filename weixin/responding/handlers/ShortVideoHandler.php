<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\ShortVideo;
use weixin\base\Weixin;
use weixin\messages\response\TextMsg;
use weixin\responding\Responsor;

/**
 * Class ShortVideoHandler 小视屏消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class ShortVideoHandler extends Component implements MessageHandler
{
    /**
     * @param Responsor $responsor 响应器
     * @param ShortVideo $ShortVideo 小视屏消息
     */
    public function handle($responsor, $ShortVideo)
    {
        $msg = '';
        if($responsor->isDebug()){
            $msg = new TextMsg($ShortVideo);
            $content = "消息属性：\n";
            foreach($ShortVideo as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}