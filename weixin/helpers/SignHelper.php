<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\helpers;

/**
 * Class SignHelper
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class SignHelper
{
    public static function buildString(array $params, $prefix=null, $separator='&')
    {
        $str = '';
        foreach($params as $key=>$value)
        {
            $str .= $key.'='.$value.$separator;
        }
        return $prefix.rtrim($str, '&');
    }


    public static function wxSign(array $params)
    {
        ksort($params, SORT_STRING);
        return sha1(self::buildString($params));
    }
}