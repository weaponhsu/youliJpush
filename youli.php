<?php
if (! file_exists(realpath(dirname(__FILE__)) . '/vendor/autoload.php'))
    exit('not exit');

require_once realpath(dirname(__FILE__)) . '/vendor/autoload.php';

use ylPush\Push;

$header = [
    'Content-Type: application/json'
];
//$param = '{"platform":"all","audience":"all","notification":{"alert":"Hi,JPush !","android":{"extras":{"android-key1":"android-value1"}},"ios":{"sound":"sound.caf","badge":"+1","extras":{"ios-key1":"ios-value1"}}}}';
$param = '{"platform":"all","audience":"all","notification":{"alert":"Hi,JPush!"}}';
$param_arr = json_decode($param, true);
var_dump($param_arr);

$push = new Push();
$push->params = $param_arr;
$push->setHeader($header);
$push->setAppKey('0ae1ec8e2d1c6aaa0f45aeb1');
$push->setMasterSecret('25c3f5981d3a396561dd11aa');

var_dump($push->jpush->pushPost()->getResp());
