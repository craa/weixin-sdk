<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\request;

/**
 * Class Text 文本消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Text extends BaseMessage
{
    /**
     * @var string 文本消息内容
     */
    public $Content;
    /**
     * @var float 消息ID, 64位整型
     */
    public $MsgId;

}