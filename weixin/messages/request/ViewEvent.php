<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\request;

/**
 * Class ViewEvent 点击菜单跳转链接事件消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class ViewEvent extends BaseEventMessage
{
    /**
     * @var string 事件KEY值，设置的跳转URL
     */
    public $EventKey;
}