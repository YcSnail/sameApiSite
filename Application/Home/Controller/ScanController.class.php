<?php
namespace Home\Controller;
use Think\Controller;
class ScanController extends Controller {


    public function Scan100(){
        $this->display();
    }

    public function Scan110(){
        $this->display();
    }

    public function Scan120(){
        $this->display();
    }

    public function Scan130(){
        $this->display();
    }

    public function Scan140(){
        $this->display();
    }

    public function Scan150(){
        $this->display();
    }


    /**
     * 调用数据库数据
     *
     */
    public function ajax(){

        checkParames($_POST);

        $parames = array();

        // EmpValidate用户验证 保存之前先拜访人是否存在
        if ($_POST['code'] == 'EmpValidate'){
            $parames['code'] = 'EmpValidate';
            $parames['gname'] = $_POST['gname'];
        }else

        // 获取是否存在 cookie
        if ($_POST['code'] == 'getCookie' ){

            if (!empty($_COOKIE['userData'])){
                $userData = json_decode($_COOKIE['userData'],true);
                ajaxRes(0,$userData);
            }

            ajaxRes(-1,'not cookie');
        }else

        // APPHA022_1 保存 访客信息
        if ($_POST['code'] == 'APPHA022_1'){

            $parames['h22name'] = $_POST['h22company'];
            $parames['h22company'] = $_POST['h22company'];
            $parames['h22tel'] = $_POST['h22tel'];
            $parames['h22visitdate'] = $_POST['h22visitdate'];

            $parames['h22peoplecnt'] = $_POST['h22peoplecnt'];
            $parames['h22vehicleno'] = $_POST['h22vehicleno'];
            $parames['h22empname'] = $_POST['h22empname'];
            $parames['h22memo'] = $_POST['h22memo'];
            $parames['h22emptel'] = $_POST['h22emptel'];
            $parames['h22code'] = $_POST['h22code'];

            $parames['code'] = 'APPHA023_1';

            $this->svavCookie($parames);
        }else

        // 设备获取最近一条记录
        if ($_POST['code'] == 'APPHA023_5'){

            $parames['h23code'] = $_POST['h23code'];
            $parames['code'] = 'APPHA023_1';
        }else

        //保存设备记录
        if ($_POST['code'] == 'APPHA023_1'){

            $parames['code'] = $_POST['code'];
            $parames['h23code'] = $_POST['h23code'];
            $parames['h23desc'] = $_POST['h23desc'];
            $parames['h23date'] = $_POST['h23date'];

            $parames['h23nums'] = $_POST['h23nums'];
            $parames['h23empid'] = $_POST['h23empid'];
            $parames['h23empname'] = $_POST['h23empname'];
            $parames['h23type'] = $_POST['h23type'];
        }else

            //获取 最近保存的5条记录
        if ($_POST['code'] == 'APPHA023_3'){

            $parames['code'] = $_POST['APPHA023_3'];
            $parames['h23code'] = $_POST['h23code'];
        }


        $IndexLogic = D('Index','Logic');
        $dataRes = $IndexLogic->_getSoapData($parames);

        ajaxRes($dataRes,'',1);
    }

    /**
     * 设置cookie
     * @param $data
     */
    public function svavCookie($data){

        if (empty($data)){
            return;
        }

        $saveDate = array_values($data);

        if (empty($saveDate)){
            return;
        }

        // 设置 1年有效期
        setcookie('userData',$saveDate, time() + 1 * 365 * 24 * 3600);
    }



}