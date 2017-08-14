<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){

        echo 'noting';
        die();
        $this->display();
    }


    /**
     * 请假审批页面
     */
    public function check(){

        $this->display();
    }

    /**
     * 个人请假记录页面
     */
    public function leave(){
        $this->display();
    }

    /**
     * 计时器页面
     */
    public function time(){
        $this->display();
    }


    /**
     * 展示 查询请假记录详细信息
     */
    public function detail(){

        $this->display();
    }

    /**
     * 访客登记
     */
    public function visitor(){

        // 获取 门禁编号
        /**
         *
        $h22code = empty($_GET['h22code']) ?  $_POST['h22code'] : $_GET['h22code'];
        if ( empty($h22code)  ){
        echo '门禁编号不能为空';
        die();
        }
        $this->assign('name',$value);

         *
         */

        /**
         * code
         * EmpValidate  用户验证 保存之前先拜访人是否存在
         * APPHA022_1   保存 访客信息
         */


        $this->assign('h22code','1365651');
        $this->display();
    }

    /**
     * 吸烟登记
     */
    public function smoke(){
        $this->display();
    }

    public function HA023(){

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
        }

        // 获取是否存在 cookie
        if ($_POST['code'] == 'getCookie' ){

            if (!empty($_COOKIE['userData'])){
                $userData = json_decode($_COOKIE['userData'],true);
                ajaxRes(0,$userData);
            }

            ajaxRes(-1,'not cookie');
        }

        // APPHA022_1 保存 访客信息
        if ($_POST['code'] == 'APPHA022_1' ){

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

            $parames['code'] = 'APPHA022_1';

            $this->svavCookie($parames);
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