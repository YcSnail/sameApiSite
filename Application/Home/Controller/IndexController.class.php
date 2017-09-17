<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    protected $wsUrl = 'http://10.1.0.5:9099/soap?service=MyValeService';
    protected $appId;
    protected $appSecret;
    protected $openId;
    protected $ddConfig;
    protected $userid;

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
     * 完成品入库 前搜索
     */
    public function inv002S(){
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

        $code = $_POST['code'];

        // EmpValidate用户验证 保存之前先拜访人是否存在
        if ($code == 'EmpValidate'){
            $parames['code'] = 'EmpValidate';
            $parames['gname'] = $_POST['gname'];
        }else

        // 获取是否存在 cookie
        if ($code == 'getCookie' ){

            if (!empty($_COOKIE['userData'])){
                $userData = json_decode($_COOKIE['userData'],true);
                ajaxRes(0,$userData);
            }

            ajaxRes(-1,'not cookie');
        }else

        // APPHA022_1 保存 访客信息
        if ($code == 'APPHA022_1'){

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
        }else

        // 设备获取最近一条记录
        if ($code == 'APPHA023_5'){

            $parames['h23code'] = $_POST['h23code'];
            $parames['code'] = 'APPHA023_5';

            $data ='{"code":0,"message":[{"ID":"07F7650306494A70AA206951CCFE3229","SEQ":2,"H23TYPE":"A","H23CODE":"0009","H23POSITION":"position0001","H23DESC":"fsdfsdfsdf","H23NUMS":8,"H23DATE":"2017-08-13 13:25:59"}]}';
            die($data);
        }else

        //保存设备记录
        if ($code == 'APPHA023_1'){

            $parames['code'] = 'APPHA023_1';

            $parames['h23code'] = $_POST['h23code'];
            $parames['h23desc'] = $_POST['h23desc'];
            $parames['h23date'] = $_POST['h23date'];
            $parames['h23nums'] = $_POST['h23nums'];
            $parames['h23empid'] = $_POST['h23empid'];
            $parames['h23empname'] = $_POST['h23empname'];
            $parames['h23type'] = $_POST['h23type'];


            $data = '{"code":0,"message":"Successful"}';

            //{"code":-1,"message":" ******failure"}
            die($data);

        }else

            //获取 最近保存的5条记录
        if ( $code == 'APPHA023_3') {

            $parames['code'] = $_POST['APPHA023_3'];
            $parames['h23code'] = $_POST['h23code'];

            $data = '{"code": 0,"message": [{"ID": "1CB985FCB48A4BC9A089C433854A2E46","SEQ": 4,"STATUS": "A","CREATEDATE": "10-8月 -17","CREATEBY": "张三","CHANGEDATE": "10-8月 -17","CHANGEBY": "张三","FK_ID": "07F7650306494A70AA206951CCFE3229","H23TYPE": "A","H23CODE": "0009","H23DESC": "desc001","H23NUMS": 8,"H23DATE": "12-8月 -17","H23EMPID": "empid0001","H23EMPNAME": "name001","H23MEMO": "memo00001"},{"ID": "1CB985FCB48A4BC9A089C433854A2E46","SEQ": 3,"STATUS": "A","CREATEDATE": "10-8月 -17","CREATEBY": "张三","CHANGEDATE": "10-8月 -17","CHANGEBY": "张三","FK_ID": "07F7650306494A70AA206951CCFE3229","H23TYPE": "A","H23CODE": "0009","H23DESC": "desc001","H23NUMS": 8,"H23DATE": "09-8月 -17","H23EMPID": "empid0001","H23EMPNAME": "name001","H23MEMO": "memo00001"},{"ID": "1CB985FCB48A4BC9A089C433854A2E46","SEQ": 2,"STATUS": "A","CREATEDATE": "10-8月 -17","CREATEBY": "张三","CHANGEDATE": "10-8月 -17","CHANGEBY": "张三","FK_ID": "07F7650306494A70AA206951CCFE3229","H23TYPE": "A","H23CODE": "0009","H23DESC": "desc001","H23NUMS": 8,"H23DATE": "13-8月 -17","H23EMPID": "empid0001","H23EMPNAME": "name001","H23MEMO": "memo00001"},{"ID": "94C010C8F1244D64ACCD659A93476A6E","SEQ": 1,"STATUS": "A","CREATEDATE": "10-8月 -17","CREATEBY": "张三","CHANGEDATE": "10-8月 -17","CHANGEBY": "张三","FK_ID": "fsdfsdgsdgsdgsdg","H23TYPE": "A","H23CODE": "0009","H23DESC": "DESCSDFSDFSDF","H23NUMS": 8,"H23DATE": "08-8月 -17","H23EMPID": "empid0001","H23EMPNAME": "name001","H23MEMO": "memo00001"},{"ID": "71171313CB90471EAAAA0D10B00CA5B5","SEQ": 0,"STATUS": "A","CREATEDATE": "10-8月 -17","CREATEBY": "张三","CHANGEDATE": "10-8月 -17","CHANGEBY": "张三","FK_ID": "fsdfsdgsdgsdgsdg","H23TYPE": "A","H23CODE": "0009","H23DESC": "DESCSDFSDFSDF","H23NUMS": 8,"H23DATE": "08-8月 -17","H23EMPID": "empid0001","H23EMPNAME": "name001","H23MEMO": "memo00001"}]}';

            die($data);

        } else

            // 获取 吸烟登记 状态
        if ($code == 'APPHA021_1'){

            $parames['code'] = 'APPHA021_1';
            $parames['id'] = $_POST['id'];

            $data  = '{"code": 0,"message": {"ID": "1DF91C19502F41588CA5A0BDC7D2423D","SEQ": 12,"STATUS": "A","CREATEDATE": "10-8月-17","CREATEBY": "张三","CHANGEDATE": "10-8月-17","CHANGEBY": "张三","H21CODE": "0009","H21EMPID": "empid0001","H21OPENID": "openid001","H21NAME": "name001","H21START": "08-8月-17","H21END": "08-8月-17","H21MEMO": "memo00001"}}';

            die($data);
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