<?php
namespace Home\Controller;
use Think\Controller;
class BoyalifeController extends Controller {

    public function index(){
        echo 'noting';
        die();
        $this->display();
    }


    /**
     * 假期申请审批
     */
    public function hrcheck(){
        $this->display();
    }

    /**
     * 加班
     */
    public function overtime(){
        $this->display();
    }

}