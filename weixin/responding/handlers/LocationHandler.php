<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding\handlers;

use weixin\base\Component;
use weixin\base\MessageHandler;
use weixin\messages\request\Location;
use weixin\base\Weixin;
use weixin\messages\response\TextMsg;
use weixin\responding\Responsor;

/**
 * Class LocationHandler 位置消息处理器
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class LocationHandler extends Component implements MessageHandler
{
    /**
     * @param Responsor $responsor 响应器
     * @param Location $Location 地理位置消息
     */
    public function handle($responsor, $Location)
    {
        $msg = '';
        if($responsor->isDebug()){
            $msg = new TextMsg($Location);
            $content = "消息属性：\n";
            foreach($Location as $key=>$value)
            {
                $content .= ''.$key.'：'.$value."\n";
            }
            $msg->setContent($content);
        }
        return $msg;
    }
}