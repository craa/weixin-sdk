<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\base;

/**
 * Trait XMLableTrait
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
trait XMLableTrait
{
    public function toXML(array $fields = [], $recusive = true)
    {
        $array = [];
        if ($this instanceof Arrayable) {
            $array = $this->toArray($fields, $recusive);
        }

        return $this->createXML($array);
    }

    protected function createXML($array)
    {
        return '<xml>' . $this->arrayToXML($array) . '</xml>';
    }

    protected function arrayToXML($array)
    {
        $child = '';
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = $this->arrayToXML($value);
            } elseif (is_string($value)) {
                $value = '<![CDATA[' . $value . ']]>';
            }
            $child .= is_numeric($key) ? $this->buildPare('item', $value) : $this->buildPare($key, $value);
        }

        return $child;
    }

    protected function buildPare($key, $value)
    {
        return "<$key>" . $value . "</$key>";
    }
}