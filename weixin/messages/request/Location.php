<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\request;

/**
 * Class Location 地理位置消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Location extends BaseMessage
{
    /**
     * @var double 地理位置纬度
     */
    public $Location_X;

    /**
     * @var double 地理位置经度
     */
    public $Location_Y;

    /**
     * @var int 地图缩放大小
     */
    public $Scale;

    /**
     * @var string 位置信息
     */
    public $Label;

    /**
     * @var float 消息ID，64位整型
     */
    public $MsgId;
}