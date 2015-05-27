<?php

namespace tanlabs\micropay\core;

class CloseOrderRequest
{
    public $appid;

    public $mch_id;

    public $out_trade_no;

    public $nonce_str;

    public $sign;
}

