<?php

namespace Home\Logic;
use \Think\Model;

class IndexLogic{

    public $wsUrl = 'http://www.aatmwf.com:3390/SOAP';
    protected $autoCheckFields = false;
    public $soapClient = null;


    public function _getSoapData($params) {

        if (empty($params['code'])) {
            ajaxRes(-1,'访问接口不存在');
        }

        $this->log($params);

        try {
            $url = $this->wsUrl;
            $options = [
                "connection_timeout" => 5,
                "compression" => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP
            ];

            $soapClient = new \SoapClient($url, $options);
            $data = $soapClient->__soapCall ( $functionName = 'doolapprocess',
                [['aParam' => json_encode($params)]] );

            if (!empty($data->Result)) {
                $data = json_decode($data->Result, 1);
            }
            $this->log($data);
        } catch (\Exception $e) {
            $this->log($e);
        }

        return $data;
    }

    private function log($e, $fileName = '') {
        if ($fileName == '') {
            $fileName = date('Ymd').'.log';
        }
        file_put_contents("./logs/" . $fileName, date('Y-m-d H:i:s') . ":". print_r($e, 1). "\n", FILE_APPEND);
    }



}