<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\messages\request;

/**
 * Class ShortVideo 小视频消息
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class ShortVideo extends BaseMessage
{
    public $MediaId;    //语音消息媒体id，可以调用多媒体文件下载接口拉取该媒体
    public $Format; //语音格式：amr
    public $Recognition;    //语音识别结果，UTF8编码(开通语音识别后才会推送该字段)
    public $MsgID;  //消息id，64位整型
}