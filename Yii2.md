# Yii Framework 2.0 接入方法

1. 将开发包复制到项目根目录
2. 配置扩展

    config/web.php
	```php
	<?php
	
	$config = [
		...
		'extensions' => [
	        [
	            'name' => 'craa\weixin-sdk',
	            'alias' => [
	                '@weixin' => '@app/weixin'
	            ],
	        ]
	    ],
		...
	];
	
	return $config;
	```

3. 使用

	现在可以直接在控制器中使用
	
	WeixinCallBackController.php
	```php
	<?php
	...
		public function actionIndex()
		{
			$config = [
			    'debug' => true,
			    'components' => [
					'account' => [
						'token' => 'weixin',
					],
			        'responsor' => [
			            'debug' => true,
			        ],
			    ],
			];
	
			//接入自动回复
			(new \weixin\Weixin($config))->getResponsor()->run();
		}
	```
	也可以配置为组件
	
	main.php
	```php
	<?php
	
	return array(
		...
		'components' => [
			'weixin01'=>[
	            'class' => '\weixin\Weixin',
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
	        ],
		],
	);
	```
	WeixinCallBackController.php
	```php
	<?php
	...
		public function actionIndex()
		{
			//接入自动回复
			Yii::$app->weixin01->getResponsor()->run();
		}
	```
