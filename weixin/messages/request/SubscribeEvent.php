<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\request;

/**
 * Class SubscribeEvent 关注事件消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class SubscribeEvent extends BaseEventMessage
{
    /**
     * 当未关注用户通过扫描场景二维码关注时，消息会增加该字段
     * @var string 事件key
     */
    public $EventKey;

    /**
     * 当未关注用户通过扫描场景二维码关注时，消息会增加该字段
     * @var string 该场景二维码的ticket，可用于换取二维码图片
     */
    public $Ticket;
}