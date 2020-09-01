<?php


namespace ylPush\provider;


use ylPush\core\Container;
use ylPush\functions\Msg\Jiguang;
use ylPush\interfaces\Provider;

class JiguangPushProvider implements Provider
{
    public function serviceProvider(Container $container) {

        $container['jpush'] = function ($container){
            return new Jiguang($container);
        };
    }

}
