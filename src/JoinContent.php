<?php
namespace JoinContentSdk;

class JoinContent
{
    // 返回数据统计的字段
    private static $keys = [
        'contentId',            // 文章ID
        'intPageReadCount',     // 阅读量，没有传 -1
        'shareCount',           // 分享数，没有传 -1
        'addToFavCount',        // 收藏数，没有传 -1
        'commentCount'          // 评论量，没有传 -1
    ];

    /**
     * 主要功能：检查数据返回字段并加签
     * @param array $data
     * @param string $app_id
     * @param string $app_secret
     * @return false|string
     * @throws \Exception
     */
    public static function statistics(array $data, string $app_id, string $app_secret)
    {
        if (empty($data)) throw new \Exception('空数据');

        foreach ($data as $datum) {
            $keys = array_keys($datum);
            if (empty($keys)) throw new \Exception('数据格式错误');
            sort($keys);

            if (count($keys) != 5) throw new \Exception('数据格式错误');
            if (count(array_diff($keys, self::$keys)) != 0) throw new \Exception('数据格式错误');
        }

//        $timestamp = time();
//        $sign = Encrypt::sign($app_id, $app_secret, $timestamp);
//
//        return json_encode([
//            'app_id'=>$app_id,
//            'timestamp'=>$timestamp,
//            'sign'=>$sign,
//            'data'=>$data
//        ]);

        return json_encode($data);
    }

    /**
     * 接收数据并验签
     * @throws \Exception
     */
    public static function receive()
    {

        try {
            // 检查签名
            $query_string = $_SERVER['QUERY_STRING'];
            parse_str($query_string, $query_strings);
            $checkRes = Encrypt::check($query_strings);
            if (!$checkRes) throw new \Exception('验签失败');

            // post 数据接收
            $data = file_get_contents('php://input');
            $params = json_decode($data, true);

            // 将内容保存起来
            $arr = [
                'contentId'=>$params['contentId'],  // 文章ID
                'title'=>$params['title'],  // 标题
                'content'=>$params['content'], // 文章内容或视频链接
                'type'=>$params['type'], // 类型，1图文2视频
                'picture'=>json_decode($params['picture']),  // 封面图
                'anchors'=>!empty($params['anchors']) ? json_decode($params['anchors']) : '', // 文章锚点列表
                'description'=>$params['description'] // 文章简介或视频描述
            ];

            return $arr;
        } catch (\Exception $exception) {
            file_put_contents(__DIR__ . '/error.txt', $exception->getMessage());
            throw new \Exception('数据接收失败：'.$exception->getMessage());
        }
    }

}