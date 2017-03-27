<?php

require 'vendor/autoload.php';

use YiiDingBot\YiiDingBot;

$msg = "钉钉通知";
YiiDingBot::sendMessage("technology", $msg);