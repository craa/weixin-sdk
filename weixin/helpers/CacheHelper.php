<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\helpers;

use weixin\caching\Cache;

/**
 * Class CacheHelper
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class CacheHelper
{
    /**
     * 缓存
     * @param Cache $cache 缓存组件
     * @param string $key 缓存key
     * @param callable $callable
     * @param bool $refresh 是否刷新缓存数据
     * @param int $duration 缓存期限
     * @param null $dependency 缓存依赖
     * @return mixed
     */
    public static function cache(Cache $cache, $key, callable $callable, $refresh = false, $duration = 7000, $dependency = null)
    {
        if ($cache) {
            $value = $cache->get($key);
            if (!$value || $refresh) {
                $value = call_user_func($callable);
                $cache->set($key, $value, $duration, $dependency);
            }

            return $value;
        }

        return call_user_func($callable);
    }
}