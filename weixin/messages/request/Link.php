<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\request;

/**
 * Class Link 链接消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Link extends BaseMessage
{
    /**
     * @var string 消息标题
     */
    public $Title;

    /**
     * @var string 消息描述
     */
    public $Description;

    /**
     * @var string 消息链接
     */
    public $Url;

    /**
     * @var float 消息ID, 64位整型
     */
    public $MsgId;
}