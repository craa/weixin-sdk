<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\request;

use weixin\base\Model;

/**
 * Class BaseMessage 用户请求消息基础模型
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class BaseMessage extends Model
{
    /**
     * @var string 开发者微信号
     */
    public $ToUserName;
    /**
     * @var string OpenID
     */
    public $FromUserName;
    /**
     * @var int 消息创建时间 （整型）
     */
    public $CreateTime;
    /**
     * @var string 消息类型
     */
    public $MsgType;

    /**
     * @return string 消息处理器组件名
     */
    public function getHandlerName()
    {
        return strtolower($this->MsgType) . 'Handler';
    }
}