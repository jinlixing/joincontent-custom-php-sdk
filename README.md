# joincontent-custom-php-sdk
内容中台对外发布sdk，php 版本

#### 安装方式
```php
composer require jlx/joincontent-custom-php-sdk
```

#### 对接方式
- 向内容中台申请对接
- 提供发布接口和数据统计接口地址
- 提供 app_id 和 app_secret 

#### 发布接口
- 接收数据
```php
$data = JoinContent::receive()
```
- 使用接收到的数据完成自己的业务逻辑即可
- 数据字段如下：

名称|类型|必须|备注
:-:|:-:|:-:|:-:
contentId|integer|是|文章ID
title|string|是|文章标题
content|string|是|文章内容或视频链接
type|integer|是|类型，1图文2视频
anchors|json string|是|锚点列表，json字符串，视频类型此字段为空
picture|json string|是|封面图json列表
description|string|是|文章简介或视频描述

#### 数据统计接口
- 每日统计，早8:00左右内容中台会请求对应接口获取前一天数据
- 将前一天的数据传入下面的方法返回即可：
```php
JoinContent::statistics($data)
```
- 每条数据字段如下：

名称|类型|必须|备注
:-:|:-:|:-:|:-:
contentId|integer|是|文章ID
intPageReadCount|integer|是|阅读量
shareCount|integer|是|分享量
addToFavCount|integer|是|收藏量
commentCount|integer|是|评论量