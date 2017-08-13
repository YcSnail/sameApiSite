<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 17.8.10 Time: 15:55
// +----------------------------------------------------------------------
namespace Home\Model;
use Think\Model;

class IndexModel extends Model {

    protected $wsUrl = 'http://localhost:9099/soap?service=MyValeService';

    public $soapClient = null;


    private function _getSoapData($params) {
        $data = ['code' => -1];


        var_dump($data);
        die();

        if (!$this->userid) {
            //return $data;
        }

//        $params['user'] = 'kdw';//'FANGDING';// 'ZHENGYANYANG';// 'YIJULU'; 'LISALI'; //$this->userid;
//        $params['userid'] = $this->userid;

        $this->log($params);
        try {
            $url = $this->wsUrl;
            $options = [
                "connection_timeout" => 5,
                "compression" => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP
            ];

            if (!$this->soapClient){
                $this->soapClient = new \SoapClient($url, $options);
            }

            $data = $this->soapClient->__soapCall ( $functionName = 'doolapprocess',
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


