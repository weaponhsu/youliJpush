<?php


namespace ylPush\functions\Report;


use ylPush\core\BaseClient;

class JPushReport extends BaseClient
{
    const JPUSH_REPORT_URL = "https://report.jpush.cn";

    /**
     * 根据msg_id获取推送结果
     * msg_ids 推送 API 返回的 msg_id 列表，多个 msg_id 用逗号隔开，最多支持 100 个 msg_id
     * 返回结果：
     * jpush_received 极光通道用户送达数；包含普通Android用户的通知+自定义消息送达，iOS用户自定义消息送达；如果无此项数据则为 null。
     * android_pns_sent Android厂商用户推送到厂商服务器成功数，计算方式同 Android厂商成功数；如果无此项数据则为 null。
     * android_pns_received Android厂商用户推送达到设备数，计算方式以厂商回调数据为准；如果无此项数据则为 null。20200324新增指标
     * ios_apns_sent iOS 通知推送到 APNs 成功。如果无此项数据则为 null。
     * ios_apns_received iOS 通知送达到设备。如果无项数据则为 null。统计该项请参考 集成指南高级功能-通知送达统计 。
     * ios_msg_received iOS 自定义消息送达数。如果无此项数据则为 null。
     * wp_mpns_sent winphone通知送达。如果无此项数据则为 null。
     * @return mixed
     * @throws \Exception
     */
    public function receiveDetail() {
        $this->base_url = self::JPUSH_REPORT_URL;

        $this->url_info = '/v3/received/detail';

        return $this->get();
    }

    /**
     * 根据msg_id与registration_ids获取推送结果
     * msg_id必须是int
     * 返回结果
     * 0: 送达；
     * 1: 未送达；
     * 2: registration_id 不属于该应用；
     * 3: registration_id 属于该应用，但不是该条 message 的推送目标；
     * 4: 系统异常。
     * @return mixed
     * @throws \Exception
     */
    public function message() {
        $this->base_url = self::JPUSH_REPORT_URL;

        $this->url_info = '/v3/status/message';

        return $this->post();
    }

}
