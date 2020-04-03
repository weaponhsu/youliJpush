<?php


namespace ylPush\provider;


use ylPush\core\Container;
use ylPush\functions\Device\JPushDevice;
use ylPush\interfaces\Provider;

class JPushDeviceProvider implements Provider
{
    public function serviceProvider(Container $container)
    {
        $container['jpush_device'] = function ($container){
            return new JPushDevice($container);
        };
    }
}
