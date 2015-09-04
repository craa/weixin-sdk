# Yii Framework 1.0 接入方法

1. 将开发包复制到@app/protected/extensions目录下
2. 配置别名
 
	main.php
	```php
	<?php
	
	return array(
		...
		'aliases' => array(
			'weixin' => 'ext.weixin',
		),
	);
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
		'components' => array(
			'weixin01' => array(
				'class' => '\weixin\Weixin',
				'debug' => true,
				'components' => array(
					'account' => array(
						'token' => 'weixin',
						'appid' => '',
						'appsecret' => '',
					),
					'responsor' => array(
			            'debug' => true,
			        ),
				),
			),
		),
	);
	```
	WeixinCallBackController.php
	```php
	<?php
	...
		public function actionIndex()
		{
			//接入自动回复
			Yii::app()->weixin01->getResponsor()->run();
		}
	```