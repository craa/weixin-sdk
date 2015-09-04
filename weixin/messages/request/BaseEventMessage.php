<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\request;

/**
 * Class BaseEventMessage 事件消息基础模型
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class BaseEventMessage extends BaseMessage
{
    /**
     * @var string 事件类型
     */
    public $Event;

    /**
     * @return string 消息处理器组件名
     */
    public function getHandlerName()
    {
        return strtolower($this->Event) . 'EventHandler';
    }
}