<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\api\common\models;

use weixin\base\Model;

/**
 * Class AccessToken
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class AccessToken extends Model
{
    private $access_token;

    private $expires_in;

    /**
     * @return mixed
     */
    public function getAccess_Token()
    {
        return $this->access_token;
    }

    /**
     * @param mixed $access_token
     */
    public function setAccess_Token($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * @return mixed
     */
    public function getExpires_In()
    {
        return $this->expires_in;
    }

    /**
     * @param mixed $expires_in
     */
    public function setExpires_In($expires_in)
    {
        $this->expires_in = $expires_in;
    }
}