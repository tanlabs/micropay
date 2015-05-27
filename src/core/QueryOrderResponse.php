<?php

namespace tanlabs\micropay\core;

class QueryOrderResponse
{
    public $return_code;
    public $return_msg;
    public $appid;
    public $mch_id;
    public $nonce_str;
    public $sign;
    public $result_code;
    public $device_info;
    public $openid;
    public $is_subscribe;
    public $trade_type;
    public $trade_state;
    public $bank_type;
    public $total_fee;
    public $fee_type;
    public $cash_fee;
    public $cash_fee_type;
    public $coupon_fee;
    public $coupon_count;
    // -- missing -- //
    public $transaction_id;
    public $out_trade_no;
    public $attach;
    public $time_end;
    public $trade_state_desc;
}
