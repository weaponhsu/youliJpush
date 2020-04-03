<?php


namespace ylPush\functions\push;


use ylPush\core\BaseClient;

/**
 * Class Push
 * @package ylPush\functions\push
 */
class JPush extends BaseClient
{
    const ERR_MSG = "报错[#error_code# - #error_message# - #exception#]";

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
