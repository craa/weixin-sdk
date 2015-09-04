<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\response;

use weixin\base\Model;

/**
 * Class BaseMessage 响应消息基础模型
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class BaseMessage extends Model
{
    const MSG_TYPE_TEXT = 'text';
    const MSG_TYPE_IMAGE = 'image';
    const MSG_TYPE_VOICE = 'voice';
    const MSG_TYPE_VIDEO = 'video';
    const MSG_TYPE_MUSIC = 'music';
    const MSG_TYPE_NEWS = 'news';

    /**
     * @var string 用户OpenID
     */
    private $ToUserName;
    /**
     * @var string 开发者微信号
     */
    private $FromUserName;
    /**
     * @var int 消息创建时间 （整型）
     */
    private $CreateTime;
    /**
     * @var string 消息类型
     */
    private $MsgType;

    /**
     * @param \weixin\messages\request\BaseMessage $reqMsg 请求消息模型
     * @param array $config
     */
    public function __construct($reqMsg = null, $config = [])
    {
        if ($reqMsg) {
            $this->initMessage($reqMsg);
        }

        parent::__construct($config);
    }

    /**
     * @param \weixin\messages\request\BaseMessage $reqMsg 请求消息模型
     */
    public function initMessage($reqMsg)
    {
        $this->setToUserName($reqMsg->FromUserName);
        $this->setFromUserName($reqMsg->ToUserName);
    }

    /**
     * @return array 模型转换数据时要显示的字段，子类重载时需要合并该方法返回值
     */
    public function fields()
    {
        return [
            'ToUserName',
            'FromUserName',
            'CreateTime',
            'MsgType',
        ];
    }

    /**
     * @return string
     */
    public function getToUserName()
    {
        return $this->ToUserName;
    }

    /**
     * @param string $ToUserName
     */
    public function setToUserName($ToUserName)
    {
        $this->ToUserName = $ToUserName;
    }

    /**
     * @return string
     */
    public function getFromUserName()
    {
        return $this->FromUserName;
    }

    /**
     * @param string $FromUserName
     */
    public function setFromUserName($FromUserName)
    {
        $this->FromUserName = $FromUserName;
    }

    /**
     * @return int
     */
    public function getCreateTime()
    {
        return time();
    }

    /**
     * @param int $CreateTime
     */
    public function setCreateTime($CreateTime)
    {
        $this->CreateTime = $CreateTime;
    }

    /**
     * @return string
     */
    public function getMsgType()
    {
        return $this->MsgType;
    }

    /**
     * @param string $MsgType
     */
    public function setMsgType($MsgType)
    {
        $this->MsgType = $MsgType;
    }

}