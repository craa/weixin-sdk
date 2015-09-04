<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\response;

/**
 * Class ArticleMsg 回复图文消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class ArticleMsg extends BaseMessage
{
    /**
     * @var int 图文消息条数（10条以内）
     */
    private $ArticleCount;
    /**
     * @var ArticleItem[] 多条图文消息信息，默认第一个item为大图,注意，如果图文数超过10，则将会无响应
     */
    private $Articles;

    public function fields()
    {
        return array_merge(parent::fields(), [
            'ArticleCount',
            'Articles',
        ]);
    }

    public function init()
    {
        $this->setMsgType(self::MSG_TYPE_NEWS);
        parent::init();
    }

    /**
     * 添加图文消息
     * @param ArticleItem $articleItem 单条图文内容
     */
    public function add(ArticleItem $articleItem)
    {
        $this->Articles[] = $articleItem;
    }

    /**
     * @return int
     */
    public function getArticleCount()
    {
        return count($this->Articles);
    }

    /**
     * @return array
     */
    public function getArticles()
    {
        return $this->Articles;
    }

    /**
     * @param array $Articles
     */
    public function setArticles($Articles)
    {
        $this->Articles = $Articles;
    }
}