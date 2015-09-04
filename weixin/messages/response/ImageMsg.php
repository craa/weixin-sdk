<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\response;

/**
 * Class ImageMsg 回复图片消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class ImageMsg extends BaseMessage
{
    /**
     * @var string 通过素材管理接口上传多媒体文件，得到的id
     */
    private $MediaId;

    private $Image;

    public function fields()
    {
        return array_merge(parent::fields(), [
            'Image',
        ]);
    }

    public function init()
    {
        $this->setMsgType(self::MSG_TYPE_IMAGE);
        parent::init();
    }

    /**
     * @return mixed
     */
    public function getImage()
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