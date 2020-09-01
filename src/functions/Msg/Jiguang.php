<?php


namespace ylPush\functions\Msg;



use ylPush\core\BaseClient;

class Jiguang extends BaseClient
{
    /**
     * 推送
     * @return $this
     * @throws \Exception
     */
    public function pushPost()
    {
        $this->url_info = 'v3/push';

        return $this->post();
    }
}
