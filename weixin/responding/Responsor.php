<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\responding;

use weixin\base\Application;
use weixin\base\Model;
use weixin\base\Weixin;

/**
 * Class Responsor 微信请求响应器
 *
 * 用于处理用户发送过来的消息、事件请求
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Responsor extends Application
{
    public function init()
    {

    }

    /**
     * @return bool 是否开启调试模式
     */
    public function isDebug()
    {
        return $this->getWeixin()->debug && $this->debug;
    }

    /**
     * 执行微信请求响应器应用
     */
    public function run()
    {
        $response = $this->handleRequest($this->getRequest());
        $response->send();
    }

    /**
     * 处理微信请求
     * @param Request $request
     * @return Response
     */
    public function handleRequest($request)
    {
        $result = '';
        if ($request->checkSignature($this->getWeixin()->getAccount()->getToken())) {
            if($request->isVerify()) {
                $result = $request->verifyStr();
            }else{
                $result = $this->handleMessage($request->getRequestMessage());
            }
        }

        if ($result instanceof Response) {
            return $result;
        } else {
            $response = $this->getResponse();
            $response->data = $result;

            return $response;
        }
    }

    /**
     * 处理来自微信的消息
     * @param $message
     * @return Model
     */
    public function handleMessage($message)
    {
        return $this->getMessageDispatcher()->dispatch($this, $message);
    }

    /**
     * @return Request 请求组件
     * @throws \weixin\base\Exception
     */
    public function getRequest()
    {
        return $this->get('request');
    }

    /**
     * @return Response 响应组件
     * @throws \weixin\base\Exception
     */
    public function getResponse()
    {
        return $this->get('response');
    }

    /**
     * @return MessageDispatcher 消息分配器组件
     * @throws \weixin\base\Exception
     */
    public function getMessageDispatcher()
    {
        return $this->get('messageDispatcher');
    }

    public function coreComponents()
    {
        return array_merge(parent::coreComponents(), [
            'request' => ['class' => 'weixin\responding\Request'],
            'response' => ['class' => 'weixin\responding\Response'],
            'messageDispatcher' => ['class' => 'weixin\responding\MessageDispatcher'],
            'textHandler' => ['class' => 'weixin\responding\handlers\TextHandler'],
            'imageHandler' => ['class' => 'weixin\responding\handlers\ImageHandler'],
            'voiceHandler' => ['class' => 'weixin\responding\handlers\VoiceHandler'],
            'videoHandler' => ['class' => 'weixin\responding\handlers\VideoHandler'],
            'shortvideoHandler' => ['class' => 'weixin\responding\handlers\ShortVideoHandler'],
            'locationHandler' => ['class' => 'weixin\responding\handlers\LocationHandler'],
            'linkHandler' => ['class' => 'weixin\responding\handlers\LinkHandler'],
            'subscribeEventHandler' => ['class' => 'weixin\responding\handlers\SubscribeEventHandler'],
            'unsubscribeEventHandler' => ['class' => 'weixin\responding\handlers\UnsubscribeEventHandler'],
            'scanEventHandler' => ['class' => 'weixin\responding\handlers\ScanEventHandler'],
            'locationEventHandler' => ['class' => 'weixin\responding\handlers\LocationEventHandler'],
            'clickEventHandler' => ['class' => 'weixin\responding\handlers\ClickEventHandler'],
            'viewEventHandler' => ['class' => 'weixin\responding\handlers\ViewEventHandler'],
        ]);
    }
}