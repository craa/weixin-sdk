<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\response;

/**
 * Class VoiceMsg 回复语音
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class VoiceMsg extends BaseMessage
{
    /**
     * @var string 通过素材管理接口上传多媒体文件，得到的id
     */
    private $MediaId;

    private $Voice;

    public function fields()
    {
        return array_merge(parent::fields(), [
            'Voice',
        ]);
    }

    public function init()
    {
        $this->setMsgType(self::MSG_TYPE_VOICE);
        parent::init();
    }

    /**
     * @return mixed
     */
    public function getVoice()
    {
        return ['MediaId' => $this->MediaId];
    }

    /**
     * @return string
     */
    public function getMediaId()
    {
        return $this->MediaId;
    }

    /**
     * @param string $MediaId
     */
    public function setMediaId($MediaId)
    {
        $this->MediaId = $MediaId;
    }
}