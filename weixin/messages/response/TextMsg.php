<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\response;

/**
 * Class TextMsg 回复文本消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class TextMsg extends BaseMessage
{
    private $Content;

    public function fields()
    {
        return array_merge(parent::fields(), [
            'Content',
        ]);
    }

    public function init()
    {
        $this->setMsgType(self::MSG_TYPE_TEXT);
        parent::init();
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->Content;
    }

    /**
     * @param mixed $Content
     */
    public function setContent($Content)
    {
        $this->Content = $Content;
    }

}