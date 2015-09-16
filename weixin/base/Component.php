<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\base;

/**
 * Class Component 组件
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Component extends Object
{
    protected $_guid;

    public function getGuid()
    {
        return $this->_guid;
    }

    public function setGuid($guid)
    {
        $this->_guid = $guid;
    }
}