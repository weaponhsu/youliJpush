<?php


namespace ylPush;


use ylPush\core\ContainerBase;
use ylPush\provider\JPushDeviceProvider;
use ylPush\provider\JPushProvider;
use ylPush\provider\JPushReportProvider;

/**
 * Class Push
 * @package ylPush
 */
class Push extends ContainerBase
{
    /**
     * 服务提供者
     * @var array
     */
    public function __construct($params = array())
    {
        parent::__construct($params);
    }

    protected $provider = [
        //...其他服务提供者
        JPushProvider::class,
        JPushDeviceProvider::class,
        JPushReportProvider::class
    ];
}
