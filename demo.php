<?php
/**
 * 微信公众平台接入DEMO
 *
 * @author Chen Hongwei <crains@qq.com>
 * @since 1.0
 */

require 'weixin/Weixin.php';
$config = [
    'debug' => true,
    'components' => [
        'account' => [
            'token' => 'weixin',
            'appid' => '',
            'appsecret' => '',
        ],
        'responsor' => [
            'debug' => true,
        ],
    ],
];

(new \weixin\Weixin($config))->getResponsor()->run();


