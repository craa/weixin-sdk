<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\response;

/**
 * Class MusicMsg 回复音乐消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class MusicMsg extends BaseMessage
{
    /**
     * @var string 视频标题(非必须)
     */
    private $Title;
    /**
     * @var string 视频描述(非必须)
     */
    private $Description;
    /**
     * @var string 音乐链接(非必须)
     */
    private $MusicUrl;
    /**
     * @var string 高质量音乐链接，WiFi下优先播放(非必须)
     */
    private $HQMusicUrl;
    /**
     * @var string 缩略图的媒体id，通过素材管理接口上传多媒体文件，得到的id
     */
    private $ThumbMediaId;

    private $Music;

    public function fields()
    {
        return array_merge(parent::fields(), [
            'Music',
        ]);
    }

    public function init()
    {
        $this->setMsgType(self::MSG_TYPE_MUSIC);
        parent::init();
    }

    /**
     * @return mixed
     */
    public function getMusic()
    {
        return [
            'Title' => $this->Title,
            'Description' => $this->Description,
            'MusicUrl' => $this->MusicUrl,
            'HQMusicUrl' => $this->HQMusicUrl,
            'ThumbMediaId' => $this->ThumbMediaId,
        ];
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @param string $Title
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    /**
     * @return string
     */
    public function getMusicUrl()
    {
        return $this->MusicUrl;
    }

    /**
     * @param string $MusicUrl
     */
    public function setMusicUrl($MusicUrl)
    {
        $this->MusicUrl = $MusicUrl;
    }

    /**
     * @return string
     */
    public function getHQMusicUrl()
    {
        return $this->HQMusicUrl;
    }

    /**
     * @param string $HQMusicUrl
     */
    public function setHQMusicUrl($HQMusicUrl)
    {
        $this->HQMusicUrl = $HQMusicUrl;
    }

    /**
     * @return string
     */
    public function getThumbMediaId()
    {
        return $this->ThumbMediaId;
    }

    /**
     * @param string $ThumbMediaId
     */
    public function setThumbMediaId($ThumbMediaId)
    {
        $this->ThumbMediaId = $ThumbMediaId;
    }


}