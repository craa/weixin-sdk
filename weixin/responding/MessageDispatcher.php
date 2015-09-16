<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding;

use weixin\base\Component;
use weixin\base\Exception;
use weixin\base\Model;
use weixin\messages\request\ClickEvent;
use weixin\messages\request\Image;
use weixin\messages\request\Link;
use weixin\messages\request\Location;
use weixin\messages\request\LocationEvent;
use weixin\messages\request\ScanEvent;
use weixin\messages\request\ShortVideo;
use weixin\messages\request\SubscribeEvent;
use weixin\messages\request\Text;
use weixin\messages\request\UnsubscribeEvent;
use weixin\messages\request\Video;
use weixin\messages\request\ViewEvent;
use weixin\messages\request\Voice;
use weixin\Weixin;


/**
 * Class MessageDispatcher 消息分配器
 *
 * 将消息分配给对应的处理器处理
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class MessageDispatcher extends Component
{
    /**
     * @param $message
     * @return Model
     * @throws Exception
     */
    public function dispatch($message)
    {
        if (!isset($message['MsgType'])) {
            throw new Exception('the format of the message from weixin server is wrong!');
        }

        switch($message['MsgType'])
        {
            case 'text':
                $msg = new Text();
                break;
            case 'image':
                $msg = new Image();
                break;
            case 'voice':
                $msg = new Voice();
                break;
            case 'video':
                $msg = new Video();
                break;
            case 'shortvideo':
                $msg = new ShortVideo();
                break;
            case 'location':
                $msg = new Location();
                break;
            case 'link':
                $msg = new Link();
                break;
            case 'event':
                switch($message['Event'])
                {
                    case 'subscribe':
                        $msg = new SubscribeEvent();
                        break;
                    case 'unsubscribe':
                        $msg = new UnsubscribeEvent();
                        break;
                    case 'SCAN':
                        $msg = new ScanEvent();
                        break;
                    case 'LOCATION':
                        $msg = new LocationEvent();
                        break;
                    case 'CLICK':
                        $msg = new ClickEvent();
                        break;
                    case 'VIEW':
                        $msg = new ViewEvent();
                        break;
                    default:
                        throw new Exception('unknown Event from weixin server');
                }
                break;
            default:
                throw new Exception('unknown MsgType from weixin server');
        }

        $msg->load($message);
        return Weixin::app($this)->getResponsor()->get($msg->getHandlerName())->handle($msg);
    }
}