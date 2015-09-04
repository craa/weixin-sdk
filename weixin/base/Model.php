<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\base;

/**
 * Class Model 基础数据模型
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class Model extends Component implements Arrayable, XMLable
{
    use ArrayableTrait;
    use XMLableTrait;

    /**
     * 加载数据到模型
     *
     * 仅将有set方法或者属性为公共的数据载入到模型
     *
     * @param array|Object|mixed $data 数据
     * @return $this
     */
    public function load($data)
    {
        if (!empty($data)) {
            foreach ($data as $property => $value) {
                if (!$this->canSetProperty($property, false)) {
                    $rc = new \ReflectionClass($this);
                    if (!$rc->hasProperty($property) || !$rc->getProperty($property)->isPublic()) {
                        continue;
                    }
                }

                $this->$property = $value;
            }
        }
        return $this;
    }
}