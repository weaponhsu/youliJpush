<?php


namespace ylPush;


use ylPush\core\ContainerBase;
use ylPush\provider\JPushProvider;

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
        JPushProvider::class,
        //...其他服务提供者
    ];
}
