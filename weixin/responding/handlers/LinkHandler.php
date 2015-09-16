<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\Link;
use weixin\base\Weixin;
use weixin\messages\response\TextMsg;
use weixin\responding\Responsor;

/**
 * Class LinkHandler 链接消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class LinkHandler extends Component implements MessageHandler
{
    /**
     * @param Link $link 链接消息
     * @return Textmsg
     */
    public function handle($link)
    {
        $msg = '';
        if(Weixin::app($this)->isDebug()){
            $msg = new TextMsg($link);
            $content = "消息属性：\n";
            foreach($link as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}