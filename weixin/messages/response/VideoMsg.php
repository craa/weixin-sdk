<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\response;

/**
 * Class VideoMsg 回复视频消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class VideoMsg extends BaseMessage
{
    /**
     * @var string 通过素材管理接口上传多媒体文件，得到的id
     */
    private $MediaId;
    /**
     * @var string 视频标题(非必须)
     */
    private $Title;
    /**
     * @var string 视频描述(非必须)
     */
    private $Description;

    private $Video;

    public function fields()
    {
        return array_merge(parent::fields(), [
            'Video',
        ]);
    }

    public function init()
    {
        $this->setMsgType(self::MSG_TYPE_VIDEO);
        parent::init();
    }

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return [
            'MediaId' => $this->MediaId,
            'Title' => $this->Title,
            'Description' => $this->Description,
        ];
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