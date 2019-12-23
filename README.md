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
- 返回数据字段
    - code：返回码，默认 200
    - message：错误信息，默认为空即可
    - data：返回数据，二维数组
- 每条数据字段如下：

名称|类型|必须|备注
:-:|:-:|:-:|:-:
contentId|integer|是|文章ID
intPageReadCount|integer|是|阅读量
shareCount|integer|是|分享量
addToFavCount|integer|是|收藏量
commentCount|integer|是|评论量

#### 发布文章类数据如下（封面图多可选第一张即可）：
```
[
  "contentId" => 959
  "title" => "测试文章发布测试文章发布"
  "content" => "<div style="font-size:24px;"><div style="width:100%;background:white;line-height:80px;z-index:1000;display:flex;position:fixed;top:0;justify-content:space-between;display:none" id="tabShy"><div data-link="#ueditor-id-test1" style="flex: 1 1 auto; text-align: center; font-size: 16px; color: rgb(102, 102, 102); cursor: pointer;">概述</div><div data-link="#ueditor-id-test2" style="flex: 1 1 auto; text-align: center; font-size: 16px; color: rgb(102, 102, 102); cursor: pointer;">治疗</div></div><div><strong style="font-size: 42px ;">这里是标题</strong><br/><span>这是作者</span><span>&nbsp;|&nbsp;</span><span>2019-12-01</span></div><div style="overflow: auto;overflow-x: hidden;padding-top:0px;width:100%;box-sizing:border-box"><div style="min-height:100%;position:relative" id="testshy" class="testshy"><div class="tabcontent" id="#ueditor-id-test1" name="tabcontent"><h1 style=" margin-top:40px;line-height:60px;font-size:21px;color: #333;position:relative;height: 60px;font-size:42px;font-weight:500;margin-bottom :30px;"><a name="test1"></a>概述：</h1><div>静脉曲张是指由于静脉功能不全、静脉血液淤滞、静脉管壁薄弱等因素，导致的静脉迂曲、扩张、隆起。身体多个部位的静脉均可发生曲张，最常发生的部位在下肢或腿部及裸关节。静脉曲张并不严重，但有时可能会导致其他疾病。</div><div><img src="pre1.png" style="width:100%" alt=""/><div>图1:下肢静脉曲张示意图</div></div></div><div class="tabcontent" id="#ueditor-id-test2" name="tabcontent"><h1 style=" margin-top:40px;line-height:60px;font-size:21px;color: #333;position:relative;height: 60px;font-size:42px;font-weight:500;margin-bottom :30px;"><a name="test2"></a>治疗 ：</h1><div><ul style="list-style-type: none;" class=" list-paddingleft-2"><li><p>123静脉壁功能不全<img src="/files_store/manuploadfile/20191211/27f8c23d0a036ae5f697613cb9e70474.png" _src="/files_store/manuploadfile/20191211/27f8c23d0a036ae5f697613cb9e70474.png"/></p></li><li><p>静脉瓣膜功能障碍静脉压升高、瓣膜反流、浅静脉管腔扩张，深静脉血栓形成、遗产因素等。<img src="/files_store/manuploadfile/20191211/1600ea97de399f3ad16b9e94ad3ac06e.png" _src="/files_store/manuploadfile/20191211/1600ea97de399f3ad16b9e94ad3ac06e.png"/></p></li><li><p>患者可能天生就存在静脉瓣膜缺陷或静脉壁薄弱，或在日后生活中发展形成，下肢静脉压力增加，下肢静脉损伤，静脉功能不全，超重、妊娠或从事必须长时间站立的职业等均会使下肢静脉压力增加，导致静脉曲张。</p></li></ul></div></div><div style=" bottom: 0px;height:80px;color :#aaa;text-align: center;font-size :12px;line-height :30px;padding :8px 20px">本站内容仅供医学知识科普使用，不能替代执业医师当面诊断，请谨慎参阅。</div></div></div></div><p><br/></p>"
  "type" => 1
  "anchors" => "[{"name":"\u6982\u8ff0","weight":0,"elementId":"#ueditor-id-test1"},{"name":"\u6cbb\u7597 ","weight":1,"elementId":"#ueditor-id-test2"},{"name":"\u6982\u8ff0","weight":2,"elementId":"#ueditor-id-test1"},{"name":"\u6cbb\u7597 ","weight":3,"elementId":"#ueditor-id-test2"}]"
  "description" => ""
  "picture" => array:1 [
    0 => "http://localhost/files_store/manuploadfile/20191211/55f4df98f820789d190ac4e744e5b0aa.png"
  ]
]

```

#### 发布视频数据格式如下（封面图多个取第一张即可）：
```
[
  "contentId" => 961
  "title" => "测试 视频发布测试 视频发布"
  "content" => "http://joincontent-test.oss-cn-beijing.aliyuncs.com/34/video/1/1007_e6ef81c591504131a4d9aba6b8beeb84.f10.mp4"
  "type" => 2
  "anchors" => ""
  "description" => "测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布测试 视频发布"
  "picture" => array:2 [
    0 => "http://localhost/files_store/manuploadfile/20191212/3c321721f30f3338c3b2d89d9bb6c69d/00001.jpg"
    1 => "http://localhost/files_store/manuploadfile/20191212/3c321721f30f3338c3b2d89d9bb6c69d/00001.jpg"
  ]
]
```

#### 注：验签需要使用 laravel 的 env 方法获取 app_secret，所以建议在 laravel 框架中使用，其它框架安装后修改代码即可