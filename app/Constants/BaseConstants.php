<?php

namespace App\Constants;


class BaseConstants
{
    /**
     * 项目状态
     */
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
    const PRODUCT_TYPE_POLICY_EMPLOYER =2;
    const PRODUCT_TYPE_MAP = [
        self::PRODUCT_TYPE_PROJECT              => "项目押金",
        self::PRODUCT_TYPE_POLICY_EMPLOYER      => "购买雇主责任险保单",
    ];

    /**
     * 付款渠道
     */
    const PAY_CHANNEL_WECHART =1;
    const PAY_CHANNEL_ALIPAY  =2;
    const PAY_CHANNEL_MAP = [
        self::PAY_CHANNEL_WECHART              => "wechat",
        self::PAY_CHANNEL_ALIPAY               => "alipay",
    ];

    const POLICY_TYPE_AIR      =1;
    const POLICY_TYPE_EMPLOYER =2;
    const POLICY_TYPE_MAP = [
        self::POLICY_TYPE_AIR                    => "空气治理责任险",
        self::POLICY_TYPE_EMPLOYER               => "雇主责任险",
    ];

    /**
     *雇主责任险保单状态
     */
    const EMPLOYER_POLICY_INIT =0;
    const EMPLOYER_POLICY_PAY =1;
    const EMPLOYER_POLICY_EFFECTIVE =2;
    const EMPLOYER_POLICY_EXPIRE =3;
    const EMPLOYER_POLICY_INVALID =4;
    const EMPLOYER_POLICY_MAP = [
        self::EMPLOYER_POLICY_INIT              => "未付款",
        self::EMPLOYER_POLICY_PAY               => "暂未生效",
        self::EMPLOYER_POLICY_EFFECTIVE         => "有效保单",
        self::EMPLOYER_POLICY_EXPIRE            => "已过期",
        self::EMPLOYER_POLICY_INVALID           => "失效保单",
    ];


}