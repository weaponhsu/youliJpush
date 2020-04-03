<?php


namespace ylPush\functions\Device;


use ylPush\core\BaseClient;

class JPushDevice extends BaseClient
{
    const JPUSH_DEVICE_URL = "https://device.jpush.cn";

    /**
     * 通过registration_id获取tags
     * @param $registration_id
     * @return mixed
     * @throws \Exception
     */
    public function getDevices($registration_id)
    {
        $this->base_url = self::JPUSH_DEVICE_URL;

        $this->url_info = '/v3/devices/' . $registration_id;

        return $this->get();
    }

    /**
     * 为一个标签添加或者删除设备。
     * @param $tag
     * @return mixed
     * @throws \Exception
     */
    public function updateTag($tag) {
        $this->base_url = self::JPUSH_DEVICE_URL;

        $this->url_info = '/v3/tags/' . $tag;

        return $this->post();
    }

    /**
     * 查询指定registration_id与指定tag的绑定关系
     * @param $registration_id
     * @param $tag
     * @return mixed
     * @throws \Exception
     */
    public function checkTagByRegistrationId($registration_id, $tag) {
        $this->base_url = self::JPUSH_DEVICE_URL;

        $this->url_info = '/v3/tags/' . $tag . '/registration_ids/' . $registration_id;

        return $this->get();
    }

    /**
     * 获取所有标签
     * @return mixed
     * @throws \Exception
     */
    public function getTags() {
        $this->base_url = self::JPUSH_DEVICE_URL;

        $this->url_info = '/v3/tags/';

        return $this->get();
    }

    /**
     * 通过registration_id添加tags
     * @param $registration_id
     * @return mixed
     * @throws \Exception
     */
    public function addTags($registration_id) {
        $this->base_url = self::JPUSH_DEVICE_URL;

        $this->url_info = '/v3/devices/' . $registration_id;

        return $this->post();
    }

    /**
     * 通过registration_id删除tags
     * @param $registration_id
     * @return mixed
     * @throws \Exception
     */
    public function removeTags($registration_id) {
        $this->base_url = self::JPUSH_DEVICE_URL;

        $this->url_info = '/v3/devices/' . $registration_id;

        return $this->post();
    }

    /**
     * 删除一个标签，以及标签与设备之间的关联关系。
     * @param $tag
     * @return bool
     */
    public function deleteTag($tag) {
        $this->base_url = self::JPUSH_DEVICE_URL;

        $this->url_info = '/v3/tags/' . $tag;

        return $this->delete();

    }

    /**
     * 给指定设备添加别名
     * @param $registration_id
     * @return mixed
     * @throws \Exception
     */
    public function addAliases($registration_id) {
        $this->base_url = self::JPUSH_DEVICE_URL;

        $this->url_info = '/v3/devices/' . $registration_id;

        return $this->post();
    }

    /**
     * 获取指定别名下的设备编号
     * @param $aliases
     * @return mixed
     * @throws \Exception
     */
    public function getAliases($aliases) {
        $this->base_url = self::JPUSH_DEVICE_URL;

        $this->url_info = '/v3/aliases/' . $aliases;

        return $this->get();
    }

    /**
     * 删除别名
     * @param $alias
     * @return bool
     */
    public function removeAliases($alias) {
        $this->base_url = self::JPUSH_DEVICE_URL;

        $this->url_info = '/v3/aliases/' . $alias;

        return $this->delete();
    }

    /**
     * 解绑设备与别名的绑定关系
     * @param $alias
     * @return mixed
     * @throws \Exception
     */
    public function unbindAliases($alias) {
        $this->base_url = self::JPUSH_DEVICE_URL;

        $this->url_info = '/v3/aliases/' . $alias;

        return $this->post();
    }

}
