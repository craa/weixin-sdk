<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\base;

use weixin\di\ServiceLocator;
use weixin\Weixin;

/**
 * Class Application 基础应用类
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Application extends ServiceLocator
{
    public function __construct($config = [])
    {
        $this->preInit($config);

        parent::__construct($config);
    }

    /**
     * 预初始化应用
     * 在应用构造函数中被调用，初始化应用几个重要属性
     * 如要重载此方法，请确保调用父类方法
     * @param array $config 应用配置
     */
    protected function preInit(&$config)
    {
        // 合并核心组件与自定义组件
        foreach ($this->coreComponents() as $id => $component) {
            if (!isset($config['components'][$id])) {
                $config['components'][$id] = $component;
            } elseif (is_array($config['components'][$id]) && !isset($config['components'][$id]['class'])) {
                $config['components'][$id]['class'] = $component['class'];
            }
        }
    }

    public function init()
    {

    }

    protected function registerErrorHandler(&$config)
    {

    }

    public function coreComponents()
    {
        return [];
    }
}