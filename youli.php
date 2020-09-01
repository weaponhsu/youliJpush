<?php
if (! file_exists(realpath(dirname(__FILE__)) . '/vendor/autoload.php'))
    exit('not exit');

require_once realpath(dirname(__FILE__)) . '/vendor/autoload.php';

use ylPush\Push;

//$registration_id = '18071adc0391f3ef461';
$registration_id = '171976fa8a31fd31939';

$push = new Push();

$push->setAppKey('9fe08654a214ed2edc6aea82');
$push->setMasterSecret('f1f5885fa6f92d4ea453bff0');

$header = [
    'Authorization: Basic ' . base64_encode($push->app_key . ':' . $push->master_secret),
    'Content-Type: application/json'
];
$push->setHeader($header);

// 推送
$push->params = [
    'platform' => 'all',
    'audience' => [
        'registration_id' => [$registration_id]
    ],
    'notification' => [
        'alert' => 'hello!!!'
    ],
    'message' => [
        'msg_content' => 'content',
        'title' => 'msg',
        'content_type' => 'text',
        'extras' => [
            'type' => 1, // 类型 1为跳转首页,2为跳转产品详情页,3为系统消息列表页,4为系统消息详情页
            'id' => '123', // 当type为2时表示产品编号，当type为4时表示系统消息编号
        ]
    ]
];
// 按registration_id推送消息
$res = $push->jpush->pushPost();

var_dump($res);
exit();
// ----- 推送状态 -----
// 根据msg_id获取推送结果
$push->params = [
    'msg_ids' => '58546878779594944'//$res['msg_id']
];
var_dump($push->jpush_report->receiveDetail());

$push->params = [
    'msg_id' => 47287848113245957, // 这个参数必须是int
    'registration_ids' => [
        $registration_id
    ]
];
var_dump($push->jpush_report->message());
exit();

// ----- 标签 -----
// 通过registration_id获取tags
// var_dump($push->jpush_device->getDevices($registration_id));

// 通过registration_id设置tag
//$push->params = [
//    'tags' => [
//        'add' => [
//            'android', 'test_tag'
//        ]
//    ]
//];
//var_dump($push->jpush_device->addTags($registration_id));
//var_dump($push->jpush_device->getDevices($registration_id));

// 获取所有标签
var_dump($push->jpush_device->getTags());

// 标签与resitration_id是否绑定
var_dump($push->jpush_device->checkTagByRegistrationId($registration_id, 'android'));
var_dump($push->jpush_device->checkTagByRegistrationId($registration_id, 'test_tag'));
var_dump($push->jpush_device->checkTagByRegistrationId($registration_id, 'iOS'));

// 为一个标签添加或者删除设备。
//$push->params = [
//    "registration_ids" => [
//        'add' => [
//            $registration_id
//        ],
//        'remove' => []
//    ]
//];
//var_dump($push->jpush_device->updateTag('iOS'));
//var_dump($push->jpush_device->checkTagByRegistrationId($registration_id, 'iOS'));

// 删除一个标签，以及标签与设备之间的关联关系。
var_dump($push->jpush_device->deleteTag("test_tag"));
// 获取所有标签
var_dump($push->jpush_device->checkTagByRegistrationId($registration_id, 'test_tag'));
var_dump($push->jpush_device->getTags());

// 通过registration_id删除指定tag
//$param_arr = [
//    'tags' => [
//        'remove' => [
//            'android', 'test_tag'
//        ]
//    ]
//];
//$push->params = $param_arr;
//var_dump($push->jpush_device->removeTags($registration_id));
//var_dump($push->jpush_device->getDevices($registration_id));

// ----- 别名 -----
// 通过别名获取registration_id
//var_dump($push->jpush_device->getAliases('alias_abc'));

// 删除别名
//var_dump($push->jpush_device->removeAliases('alias_abc'));

// 通过别名获取registration_id
//var_dump($push->jpush_device->getAliases('alias_abc'));

// 通过registration_id添加aliases
//$push->params = ['alias' => 'alias_abc'];
//var_dump($push->jpush_device->addAliases($registration_id));

// 接触别名与设备的绑定关系
//$push->params = [
//    'registration_ids' => [
//        'remove' => [
//            $registration_id
//        ]
//    ]
//];
//var_dump($push->jpush_device->unbindAliases('alias_abc'));

// 通过别名获取registration_id
//var_dump($push->jpush_device->getAliases('alias_abc'));

