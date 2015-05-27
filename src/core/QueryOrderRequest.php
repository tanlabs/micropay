<?php

namespace tanlabs\micropay\core;

class QueryOrderRequest
{
    public $appid;
    public $mch_id;
    public $transaction_id;
    public $out_trade_no;
    public $nonce_str;
    public $sign;
}
