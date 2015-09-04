<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\request;

/**
 * Class Video 视频消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Video extends BaseMessage
{
    public $MediaId; 	//视频消息媒体id，可以调用多媒体文件下载接口拉取数据。
    public $ThumbMediaId; 	//视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。
    public $MsgId; 	//消息id，64位整型
}