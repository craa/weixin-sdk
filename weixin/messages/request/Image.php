<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\request;

/**
 * Class Image 图片消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Image extends BaseMessage
{
    //图片链接
    public $PicUrl;
    //图片消息媒体id，可以调用多媒体文件下载接口拉取数据。
    public $MediaId;
    //消息id，64位整型
    public $MsgId;
}