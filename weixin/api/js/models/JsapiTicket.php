<?php
/**
 * @link https://github.com/craa/weixin-sdk
 */

namespace weixin\api\js\models;

use weixin\base\Model;

/**
 * Class JsapiTicket
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */
class JsapiTicket extends Model
{
    public $errcode;
    public $errmsg;
    private $ticket;
    private $expires_in;

    /**
     * @return mixed
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * @param mixed $ticket
     */
    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
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