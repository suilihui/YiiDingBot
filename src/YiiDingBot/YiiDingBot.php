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
    
    
    	protected static function getGroup($groupString)
    	{
        $yiiConf = isset(Yii::$app->params) ? Yii::$app->params : [];
        
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