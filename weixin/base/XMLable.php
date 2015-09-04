<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\base;

/**
 * Interface XMLable
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
interface XMLable
{
    public function toXML(array $fields = [], $recusive = true);
}