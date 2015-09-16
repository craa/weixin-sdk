<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\base\Weixin;
use weixin\messages\request\Image;
use weixin\messages\response\TextMsg;
use weixin\responding\Responsor;

/**
 * Class ImageHandler 图片消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class ImageHandler extends Component implements MessageHandler
{
    /**
     * @param Image $image 图像消息
     * @return TextMsg
     */
    public function handle($image)
    {
        $msg = '';
        if(Weixin::app($this)->isDebug()){
            $msg = new TextMsg($image);
            $content = "消息属性：\n";
            foreach($image as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}