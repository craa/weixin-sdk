<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\api\common\models;

use weixin\base\Model;

/**
 * Class IPList IP列表
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class IPList extends Model
{
    private $ip_list;

    /**
     * @return mixed
     */
    public function getIp_List()
    {
        return $this->ip_list;
    }

    /**
     * @param mixed $ip_list
     */
    public function setIp_List($ip_list)
    {
        $this->ip_list = $ip_list;
    }
}