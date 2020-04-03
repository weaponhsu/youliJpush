<?php


namespace ylPush\provider;


use ylPush\core\Container;
use ylPush\functions\Report\JPushReport;
use ylPush\interfaces\Provider;

class JPushReportProvider implements Provider
{
    public function serviceProvider(Container $container)
    {
        // TODO: Implement serviceProvider() method.
        $container['jpush_report'] = function ($container){
            return new JPushReport($container);
        };
    }
}
