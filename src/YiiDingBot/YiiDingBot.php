<?php

namespace YiiDingBot;

use Ding\DingBot\DingBot;
use yii\helpers\ArrayHelper;
use Yii;

class YiiDingBot
{

	/**
	 *  给钉钉机器人发送消息
	 *  $groupStr  group.at 部门+at列表
	 *  $content   消息内容
	 */
	public static function sendMessage($groupStr, $content)
   	{
        $group = self::getToken($groupStr);
        
        $bot = DingBot::getInstance($group['token']);
        $bot->sendMsg($content, $group['at']);
   	}

    /**
     * 获取机器人信息
     * @param $groupString
     * @return array
     */
    protected static function getToken($groupString)
    {
        $dingRobot = ArrayHelper::getValue(Yii::$app->params, 'DingRobot');
        $watchdog = '05dbf73b738adb746c50f99e3695a9ca9233327dd6f4431763687de9a1812491';

        if (ArrayHelper::getValue(Yii::$app->params, 'environment') != 'production') {
            return [
                'token' => ArrayHelper::getValue($dingRobot, 'dev_test.token', $watchdog),
                'at' => [],
            ];
        }

        $group = explode(".", $groupString);
        $token = (isset($group[0]) && !empty($group[0])) ?
            ArrayHelper::getValue($dingRobot, "{$group[0]}.token", $watchdog) :
            ArrayHelper::getValue($dingRobot, 'trashcan.token', '');

        $at = isset($group[1]) && !empty($group[1]) ?
            ArrayHelper::getValue($dingRobot, "{$group[0]}.at.{$group[1]}", []) : [];

        return [
            'token' => $token,
            'at' => $at,
        ];
    }
}