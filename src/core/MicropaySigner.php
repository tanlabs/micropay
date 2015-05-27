<?php

namespace tanlabs\micropay\core;

use tanlabs\micropay\MicropayConfig;

class MicropaySigner
{
    public $config;

    public function __construct($config)
    {
        if ( ! $config instanceof MicropayConfig ) {
            throw new MicropayException('The config must be an instance of MicropayConfig');
        }
        $this->config = $config;
    }

    public function MicropaySigner($config)
    {
        if ( ! $config instanceof MicropayConfig ) {
            throw new MicropayException('The config must be an instance of MicropayConfig');
        }
        $this->config = $config;
    }

    public function sign($data, $signType='SHA1')
    {
        $array = [];
        foreach ($data as $key=>$val) {
            if ($key != 'sign' && isset($val)) {
                if (!is_string($val) || (is_string($val) && $val != '')) {
                    array_push($array, $key . "=" . $val);
                }
            }
        }

        sort($array, SORT_STRING);
        $str = implode("&", $array);
        $str = $str . "&key=" . $this->config->apiKey;
        $sign = strcasecmp($signType, 'MD5') == 0 ? md5($str) : sha1($str);
        $sign = strtoupper($sign);
        return $sign;
    }
}

