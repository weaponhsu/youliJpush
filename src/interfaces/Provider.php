<?php


namespace ylPush\interfaces;


use ylPush\core\Container;

/**
 * Interface Provider
 * @package ylJpush\interfaces
 */
interface Provider
{
    public function serviceProvider(Container $container);

}
