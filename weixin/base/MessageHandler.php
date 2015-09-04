<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\base;

use weixin\messages\request\BaseMessage;

/**
 * Interface Handler 处理器接口
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
interface MessageHandler
{
    public function handle($responsor, $messag);
}