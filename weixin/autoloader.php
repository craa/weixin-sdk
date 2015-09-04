<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin;

/**
 * This constant defines the framework installation directory.
 */
defined('WEIXIN_PATH') or define('WEIXIN_PATH', __DIR__);

/**
 * Class AutoLoader
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class AutoLoader
{
    public static function autoload($class)
    {
        $class = ltrim($class, '\\');

        $pos = strpos($class, '\\');
        if($pos && substr($class, 0, $pos) == 'weixin') {
            $classFile = WEIXIN_PATH . DIRECTORY_SEPARATOR .substr(str_replace('\\', '/', $class), $pos + 1) . '.php';
            if(!is_file($classFile))
                return;

            include($classFile);
        }
    }
}

spl_autoload_register(['weixin\AutoLoader', 'autoload']);