<?php


namespace ylPush\provider;


use ylPush\core\Container;
use ylPush\functions\push\JPush;
use ylPush\interfaces\Provider;

class JPushProvider implements Provider
{
    public function serviceProvider(Container $container) {
        $container['jpush'] = function ($container){
            return new JPush($container);
        };
    }

}
