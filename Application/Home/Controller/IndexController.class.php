<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {


//    // 钉钉
//    public function __construct(){
//        parent::__construct();
//
//    }

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
    public function HA022(){

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

//        $this->display('Test/Index');
//        die();
        /**
         *
            $lastNum = empty($_GET['lastNum']) ?  $_POST['lastNum'] : $_GET['lastNum'];
            if ( empty($lastNum)  ){
            echo '上次读数不能为空';
            die();
            }
         */

        $this->assign('h22code','00009');
        $this->display();
    }


    /**
     * 泡棉上架
     */
    public function shelves(){
        $this->display();
    }


    /**
     * 完成品入库
     */
    public function shelves_tow(){
        $this->display();
    }

    /**
     * 完成品入库
     */
    public function inv002(){
        $this->display();
    }


    /**
     * 泡棉详情
     */
    public function goods(){
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