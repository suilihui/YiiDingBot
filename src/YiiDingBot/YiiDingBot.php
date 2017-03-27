<?php

namespace YiiDingBot;

use Ding\DingBot\DingBot;
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
        $group = self::getGroup($groupStr);
        
        $bot = DingBot::getInstance($group['token']);
        $bot->sendMsg($content, $group['at']);
   	}
    

    /**
     *  获取机器人信息
     */
    protected static function getGroup($groupString)
    {
        if (!isset(Yii::$app->params["DingRobot"])) {
            throw new \Exception("请在Yii的 common/config/params-local.php 中添加机器人所需数据结构，具体请查看README.md!");
        }
        $yiiConf = Yii::$app->params["DingRobot"];
        $group = explode(".", $groupString);

        if (is_array($group) && count($group) > 1)
        {
            $token = isset($yiiConf[$group[0]]['token']) ? $yiiConf[$group[0]]['token'] : '';
            $at = isset($yiiConf[$group[0]]['at'][$group[1]]) ? $yiiConf[$group[0]]['at'][$group[1]] : [];
        }
        else if (count($group) == 1)
        {
            $token = isset($yiiConf[$group[0]]['token']) ? $yiiConf[$group[0]]['token'] : '';
            $at = [];
        }
        else
        {
            $token = '';
            $at = [];
        }

        return [
            'token' => $token,
            'at' => $at,
        ];
    }
}