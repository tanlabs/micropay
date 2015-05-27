<?php

namespace tanlabs\micropay\core;

class CallbackResponse
{
    public $return_code;
    public $return_msg;
    public $appid;
    public $mch_id;
    public $device_info;
    public $nonce_str;
    public $sign;
    public $result_code;
    public $err_code;
    public $err_code_des;
    public $openid;
    public $is_subscribe;
    public $trade_type;
    public $bank_type;
    public $total_fee;
    public $fee_type;
    public $cash_fee;
    public $cash_fee_type;
    public $coupon_fee;
    public $coupon_count;
    //-- missing --//
    public $transaction_id;
    public $out_trade_no;
    public $attach;
    public $time_end;
}

