<?php

namespace tanlabs\micropay\core;

use tanlabs\micropay\MicropayConfig;
use tanlabs\micropay\util\Xmls;

use Httpful\Request;

class Micropay
{
    public $config;
    public $signer;

    public function __construct($config)
    {
        if ( ! $config instanceof MicropayConfig ) {
            throw new MicropayException('The config must be an instance of MicropayConfig');
        }
        $this->config = $config;
        $this->signer = new MicropaySigner($config);
    }

    public function Micropay($config)
    {
        if ( ! $config instanceof MicropayConfig ) {
            throw new MicropayException('The config must be an instance of MicropayConfig');
        }
        $this->config = $config;
        $this->signer = new MicropaySigner($config);
    }

    public function placeOrder($placeOrderRequest)
    {
        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";

        // generate sign
        $sign = $this->signer->sign($placeOrderRequest, 'MD5');

        $placeOrderRequest->sign = $sign;
        $xml = Xmls::encode($placeOrderRequest);
        $response = Request::post($url)->body($xml)->sendsXml()->send();
        $resbody = simplexml_load_string($response->body);

        $result = null;
        if ((isset($resbody->return_code) && $resbody->return_code == 'SUCCESS') &&
            (isset($resbody->result_code) && $resbody->result_code == 'SUCCESS')) {
            $result = new PlaceOrderResponse();
            foreach ($result as $key=>$value) {
                $result->{$key} = (string) $resbody->{$key};
            }
        } else {
            if (isset($resbody->return_code) && $resbody->return_code == 'FAIL') {
                throw new MicropayException($resbody->return_msg);
            } else if ((isset($resbody->return_code) && $resbody->return_code == 'SUCCESS') &&
                isset($resbody->result_code) && $resbody->result_code == 'FAIL') {
                throw new MicropayException($resbody->err_code, $resbody->err_code_des);
            } else {
                // nothing to do
            }
        }
        return $result;
    }

    public function queryOrder($queryOrderRequest)
    {
        $url = "https://api.mch.weixin.qq.com/pay/orderquery";

        // generate sign
        $sign = $this->signer->sign($queryOrderRequest, 'MD5');

        $queryOrderRequest->sign = $sign;
        $xml = Xmls::encode($queryOrderRequest);
        $response = Request::post($url)->body($xml)->sendsXml()->send();
        $resbody = simplexml_load_string($response->body);

        $result = null;
        if ((isset($resbody->return_code) && $resbody->return_code == 'SUCCESS') &&
            (isset($resbody->result_code) && $resbody->result_code == 'SUCCESS')) {
            $result = new QueryOrderResponse();
            foreach ($result as $key=>$value) {
                $result->{$key} = (string) $resbody->{$key};
            } 
        } else {
            if (isset($resbody->return_code) && $resbody->return_code == 'FAIL') {
                throw new MicropayException($resbody->return_msg);
            } else if ((isset($resbody->return_code) && $resbody->return_code == 'SUCCESS') &&
                isset($resbody->result_code) && $resbody->result_code == 'FAIL') {
                throw new MicropayException($resbody->err_code . ':' . $resbody->err_code_des);
            } else {
                // nothing to do
            } 
        }
        return $result;
    }

    public function closeOrder($closeOrderRequest)
    {
        $url = "https://api.mch.weixin.qq.com/pay/closeorder";

        // generate sign
        $sign = $this->signer->sign($closeOrderRequest, 'MD5');

        $closeOrderRequest->sign = $sign;
        $xml = Xmls::encode($closeOrderRequest);
        $response = Request::post($url)->body($xml)->sendsXml()->send();
        $resbody = simplexml_load_string($response->body);
        
        $result = null;
        if (isset($resbody->return_code) && $resbody->return_code == 'SUCCESS') {
            $result = new CloseOrderResponse();
            foreach ($result as $key=>$value) {
                $result->{$key} = (string) $resbody->{$key};
            }
        } else {
            if (isset($resbody->return_code) && $resbody->return_code == 'FAIL') {
                if (isset($resbody->return_msg) && $resbody->return_msg != 'OK') {
                    throw new MicropayException((string) $resbody->return_msg);
                } else {
                    throw new MicropayException($resbody->err_code . ':' . $resbody->err_code_des);
                }
            } else {
                // nothing to do
            }
        }
        return $result;
    }
}
