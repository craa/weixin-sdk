# weixin-sdk 微信公众平台开发工具包
PHP Weixin SDK 是一个基于组件的微信公众平台开发工具包,包括自动回复与API两个部分

## REQUIREMENTS
PHP >= 5.4

## 快速开始

### 脚本接入
```php
<?php
require 'weixin/Weixin.php';

$config = [
    'debug' => true,
    'components' => [
		'account' => [
			'token' => 'weixin',
			'encodingAesKey' => '', //开启加密模式需要(mcrypt>=2.4.0)
		],
    ],
];

$wxApp = new \weixin\Weixin($config);

//接入自动回复
$wxApp->getResponsor()->run();

//获取AccessToken
$accessToken = $wxApp->getApiRequestor()->getCommonAPI()->getAccessToken();
```

### 框架接入
* [Yii Framework 1.0 接入方法](<Yii1.md>)
* [Yii Framework 2.0 接入方法](<Yii2.md>)
