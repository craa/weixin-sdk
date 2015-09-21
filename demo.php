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
            'appid' => 'wx2b0939a7c90c1092',
            'appsecret' => 'd34bb0cd5a182896f2b626b21523cbe3',
            'encodingAesKey' => '',
        ],
    ],
];

$wxApp = new \weixin\Weixin($config);
$wxApp->getResponsor()->run();