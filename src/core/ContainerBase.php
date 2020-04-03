<?php


namespace ylPush\core;


/**
 * Class ContainerBase
 * @package ylPush\core
 */
class ContainerBase extends Container
{
    protected $provider = [];

    public $params = [];

    public $base_url;

    public $app_key = '';

    public $master_secret = '';

    public $access_token = '';

    public $header = [];

    public function __construct($params =array())
    {
        $this->params = $params;

        $provider_callback = function ($provider) {
            $obj = new $provider;
            $this->serviceRegister($obj);
        };
        //注册
        array_walk($this->provider, $provider_callback);
    }

    public function __get($id) {
        return $this->offsetGet($id);
    }

    /**
     * @param mixed $master_secret
     */
    public function setMasterSecret($master_secret) {
        $this->master_secret = $master_secret;
    }

    /**
     * @param mixed $app_key
     */
    public function setAppKey($app_key) {
        $this->app_key = $app_key;
    }

    /**
     * @param array $header
     */
    public function setHeader($header = []) {
        $this->header = $header;
    }
}
