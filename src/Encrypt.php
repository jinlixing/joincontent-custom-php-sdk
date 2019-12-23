<?php

namespace JoinContentSdk;

class Encrypt
{

    /**
     * 加签
     * @param string $app_id
     * @param string $app_secret
     * @param int $timestamp
     * @return string
     */
    public static function sign(string $app_id, string $app_secret, int $timestamp)
    {
        $arr = [
            'app_id'=>$app_id,
            'app_secret'=>$app_secret,
            'timestamp'=>$timestamp
        ];
        ksort($arr);

        return sha1(http_build_query($arr));
    }

    /**
     * 验签
     * @param array $params
     * @return bool
     * @throws \Exception
     */
    public static function check(array $params)
    {
        $app_id = $params['app_id'];
        if ($app_id != self::getAppId()) throw new \Exception('appId 不对应');

        $timestamp = $params['timestamp'];
        $app_secret = self::getAppSecret();

        $sign = self::sign($app_id, $app_secret, $timestamp);

        return $sign == $params['sign'];
    }

    /**
     * 设置 app_id
     */
    private static function getAppId()
    {
        if (function_exists('env')) {
            return env('Join_Content_App_Id');
        }

        return '1234567890'; // 测试用
    }

    /**
     * 设置 app_secret
     */
    private static function getAppSecret()
    {
        if (function_exists('env')) {
            return env('Join_Content_App_Secret');
        }

        return '132ewd132ad56asd1as31d3a'; // 测试用
    }

}