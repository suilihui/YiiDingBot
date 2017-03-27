# YiiDingBot

## 安装:

>  composer require suilihui/yii-ding-bot

>  composer install

## 机器人所需数据结构:
> 请在Yii的 common/config/params-local.php 中添加如下数据结构:
```
"DingRobot" => [
	"technology" => [
		   // 机器人token
	        "token" => "6e05b01c7ebed428e7b29b0d9ea06f7cf64c766e5145ae7e58947349eaa03f1a",

	        // at列表
	        "at" => [
	            "flow" => [],
	            "..."
	        ],
	    ],
    ]
```

## 测试:
> php example.php
```
use YiiDingBot\YiiDingBot;
$msg = "钉钉通知";
YiiDingBot::sendMessage("technology", $msg);
```