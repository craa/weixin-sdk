<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\request;

/**
 * Class LocationEvent 位置上报事件消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class LocationEvent extends BaseEventMessage
{
    /**
     * @var double 纬度
     */
    public $Latitude;
    /**
     * @var double 经度
     */
    public $Longitude;
    /**
     * @var double 精度
     */
    public $Precision;
}