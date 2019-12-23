<?php

namespace App\Constants;


class BaseConstants
{
    const ORDER_STATUS_INIT             = 0;
    const ORDER_STATUS_COOPERATION      = 1;
    const ORDER_STATUS_CLOSE            = 2;
    const ORDER_STATUS_CHECK            = 3;
    const ORDER_STATUS_WAIT_FOR_CHECK   = 4;
    const ORDER_STATUS_EVALUATE         = 5;
    const ORDER_STATUS_DONE             = 6;

    const ORDER_STATUS_MAP = [
        self::ORDER_STATUS_INIT              => "待合作",
        self::ORDER_STATUS_COOPERATION       => "合作中",
        self::ORDER_STATUS_CLOSE             => "未合作",
        self::ORDER_STATUS_CHECK             => "已提交验收报告",
        self::ORDER_STATUS_WAIT_FOR_CHECK    => "确认验收报告",
        self::ORDER_STATUS_EVALUATE          => "评价",
        self::ORDER_STATUS_DONE              => "完成项目",
    ];

    /**
     * 商品类型
     */
    const PRODUCT_TYPE_PROJECT =1;
    const PRODUCT_TYPE_POLICY =2;
    const PRODUCT_TYPE_MAP = [
        self::PRODUCT_TYPE_PROJECT              => "项目押金",
        self::PRODUCT_TYPE_POLICY               => "购买保单",
    ];

    /**
     * 付款渠道
     */
    const PAY_CHANNEL_WECHART =1;
    const PAY_CHANNEL_ALIPAY =2;
    const PAY_CHANNEL_MAP = [
        self::PAY_CHANNEL_WECHART              => "wechat",
        self::PAY_CHANNEL_ALIPAY               => "alipay",
    ];
}