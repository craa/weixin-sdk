<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\response;

use weixin\base\Model;

/**
 * Class ArticleItem 图文消息内容
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class ArticleItem extends Model
{
    /**
     * @var string 图文消息标题(非必须)
     */
    private $Title;
    /**
     * @var string 图文消息描述(非必须)
     */
    private $Description;
    /**
     * @var string 图片链接，支持JPG、PNG格式，较好的效果为大图360*200，小图200*200(非必须)
     */
    private $PicUrl;
    /**
     * @var string 点击图文消息跳转链接(非必须)
     */
    private $Url;

    public function fields()
    {
        return [
            'Title',
            'Description',
            'PicUrl',
            'Url',
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
    public function getPicUrl()
    {
        return $this->PicUrl;
    }

    /**
     * @param string $PicUrl
     */
    public function setPicUrl($PicUrl)
    {
        $this->PicUrl = $PicUrl;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->Url;
    }

    /**
     * @param string $Url
     */
    public function setUrl($Url)
    {
        $this->Url = $Url;
    }

}