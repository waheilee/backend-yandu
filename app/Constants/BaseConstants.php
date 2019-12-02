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
//    const ORDER_STATUS_REFUND_DONE = 7;
//    const ORDER_STATUS_RETURN_GOODS = 8;
//    const ORDER_STATUS_RETURN_GOODS_DONE = 9;


    const ORDER_STATUS_MAP = [
        self::ORDER_STATUS_INIT              => "待合作",
        self::ORDER_STATUS_COOPERATION       => "合作中",
        self::ORDER_STATUS_CLOSE             => "未合作",
        self::ORDER_STATUS_CHECK             => "已提交验收报告",
        self::ORDER_STATUS_WAIT_FOR_CHECK    => "确认验收报告",
        self::ORDER_STATUS_EVALUATE          => "评价",
        self::ORDER_STATUS_DONE              => "完成项目",
//        self::ORDER_STATUS_REFUND_DONE       => "完成项目",
//        self::ORDER_STATUS_RETURN_GOODS      => "换货中",
//        self::ORDER_STATUS_RETURN_GOODS_DONE => "已完成换货",
    ];


}