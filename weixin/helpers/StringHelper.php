<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\helpers;

/**
 * Class StringHelper
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class StringHelper
{
    /**
     * 生成随机字符串
     * @param int $length
     * @return string
     */
    public static function random($length = 16)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for ($i = 0; $i < $length; ++$i) {
            $str .= $chars[mt_rand(0, 61)];
        }
        return $str;
    }

}