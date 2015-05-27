<?php

namespace tanlabs\micropay\core;

class PlaceOrderRequest
{
    public $appid;
    public $mch_id;
    public $device_info;
    public $nonce_str;
    public $sign;
    public $body;
    public $detail;
    public $attach;
    public $out_trade_no;
    public $fee_type;
    public $total_fee;
    public $spbill_create_ip;
    public $time_start;
    public $time_expire;
    public $goods_tag;
    public $notify_url;
    public $trade_type;
    public $product_id;
    public $openid;
}
