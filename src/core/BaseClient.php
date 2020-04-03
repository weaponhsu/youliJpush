<?php


namespace ylPush\core;



/**
 * Class BaseClient
 * @package ylPush\core
 * @property \ylPush\Push app
 */
class BaseClient
{
    protected $app;

    public $base_url = 'https://api.jpush.cn/';

    public $url_info;

    protected $postData;

    public $res_url;

    public $mode = 'production';

    public $header = [];

    public function __construct(Container $app)
    {
        $this->app = $app;
    }


    /**
     * @throws \Exception
     */
    public function prepareReq(){
        if ($this->mode === 'production') {
            //url 因子
            if(empty($this->url_info)){
                throw new \Exception('url因子为空，如无配置，请配置');
            }
            $this->res_url = $this->base_url . $this->url_info;

            if (!empty($this->app->header))
                $this->header = $this->app->header;

            $this->postData = $this->app->params;
        }
    }

    public function setMode($mode = '') {
        if (!empty($mode))
            $this->mode = $mode;
    }

    /**
     * get 请求方式
     * @return mixed
     * @throws \Exception
     */
    public function get(){
        $this->prepareReq();
        $file =  $this->curlRequest($this->res_url,!empty($this->app->params) ? $this->app->params : '',
            $this->app->header,'GET');
        return json_decode($file,true);
    }

    /**
     * post 请求方式
     * @return mixed
     * @throws \Exception
     */
    public function post(){
        $this->prepareReq();
        $result = $this->curlRequest($this->res_url, json_encode($this->postData), $this->header,'POST');

        return json_decode($result, true);
    }

    public function delete() {
        $this->prepareReq();

        $this->curlRequest($this->res_url, json_encode($this->postData), $this->header,'DELETE');

        return true;
    }

    /**
     * 设置地址
     * @param $api_name
     * @return $this
     */
    public function setApi($api_name){
        $this->url_info = $api_name;
        return $this;
    }

    /**
     * curl 请求
     * @param $base_url
     * @param $query_data
     * @param $header
     * @param string $method
     * @param bool $ssl
     * @param int $exe_timeout
     * @param int $conn_timeout
     * @param int $dns_timeout
     * @return bool|string
     */
    public function curlRequest($base_url, $query_data, $header, $method = 'get', $ssl = true, $exe_timeout = 10, $conn_timeout = 10, $dns_timeout = 3600)
    {

        $ch = curl_init();

        if ($method == 'GET' || $method == 'DELETE') {
            //method get
            if ( !empty($query_data) && is_array($query_data)){
                $connect_symbol = strpos($base_url, '?') !== false ? '&' : '?';
                foreach($query_data as $key => $val) {
                    if ( is_array($val) ) {
                        $val = serialize($val);
                    }
                    $base_url .= $connect_symbol . $key . '=' . rawurlencode($val);
                    $connect_symbol = '&';
                }
            }

            if ($method == 'DELETE')
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

        } else {
            if ( !empty($query_data) && is_array($query_data)){
                foreach($query_data as $key => $val) {
                    if (is_array($val)) {
                        $query_data[$key] = serialize($val);
                    }
                }
            }
            //method post
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $query_data);
        }
        curl_setopt($ch, CURLOPT_URL, $base_url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $conn_timeout);
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, $dns_timeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $exe_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if(!empty($header)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            //返回response头部信息
            curl_setopt($ch, CURLOPT_HEADER, 0);
        }

        // 关闭ssl验证
        if($ssl){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        // 设置Basic认证
//        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//        curl_setopt($ch, CURLOPT_USERPWD, $this->app->app_key . ":" . $this->app->master_secret);
//        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);

        $output = curl_exec($ch);
//        $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
//        if ($http_code != '200')
//            throw new JPushException('asdf', $http_code);

        if ($output === false)
            $output = '';

        curl_close($ch);
        return $output;
    }

}

