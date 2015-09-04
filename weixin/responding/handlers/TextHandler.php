<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\Text;
use weixin\base\Weixin;
use weixin\messages\response\TextMsg;
use weixin\responding\Responsor;

/**
 * Class TextHandler 文本消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class TextHandler extends Component implements MessageHandler
{
    /**
     * @param Responsor $responsor 响应器
     * @param Text $text 文本消息
     */
    public function handle($responsor, $text)
    {
        $msg = '';
        if($responsor->isDebug()){
            $msg = new TextMsg($text);
            $content = "消息属性：\n";
            foreach($text as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}