<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 17.8.12 Time: 11:33
// +----------------------------------------------------------------------


$url = 'http://www.aatmwf.com:3390/SOAP';

$params = array(
    'code'=>'EmpValidate',
    'gname'=>'陈丰'
);


try {
    $options = [
        "connection_timeout" => 5,
        "compression" => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP
    ];

    $soapClient = new SoapClient($url, $options);
    $data = $soapClient->__soapCall ( $functionName = 'doolapprocess',
        [['aParam' => json_encode($params)]] );

    if (!empty($data->Result)) {
        $data = json_decode($data->Result, 1);
    }

    echo '<pre>';
    var_dump($data);
    die();

} catch (\Exception $e) {
    echo '<pre>';
    var_dump($e);
    die();
}
