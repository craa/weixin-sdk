<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\request;

/**
 * Class ClickEvent 菜单点击事件消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class ClickEvent extends BaseEventMessage
{
    /**
     * @var string 事件KEY值，与自定义菜单接口中KEY值对应
     */
    public $EventKey;
}