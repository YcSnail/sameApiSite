<?php
// +----------------------------------------------------------------------
// |  [ 我的梦想是星辰大海 ]
// +----------------------------------------------------------------------
// | Author: yc  yc@yuanxu.top
// +----------------------------------------------------------------------
// | Date: 17.8.11 Time: 13:17
// +----------------------------------------------------------------------

/**
 * 自定义函数
 */
/**
 * ajax 返回数据
 * @param $code
 * @param string $msg
 * @param int $type
 */
function ajaxRes($code,$msg = '',$type = 0){

    $arr = empty($type) ? $arr = array('code'=>$code,'message'=>$msg) : $code ;
    die(json_encode($arr));
}

/**
 * 检测变量是否为空
 * @param $data
 * @return mixed
 */
function checkEmpty($data){
    if (empty($data)){
        ajaxRes(-1,'数据不能为空');
    }
    return $data;
}

/**
 * 循环检查 数据
 * @param $arr
 */
function checkParames($arr){

    foreach ($arr as $value){
        checkEmpty($value);
    }

}
