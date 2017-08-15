<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0,user-scalable=0" />
    <link href="/Public/mui/css/mui.min.css" rel="stylesheet">
    <script src="/Public/bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="/Public/mui/js/mui.min.js"></script>
</head>
<body>
<link href="/Public/mui/css/miu.picker.min.css" rel="stylesheet">
<script src="/Public/mui/js/miu.picker.min.js"></script>
<title>能源记录平台</title>

<style>
    .mui-btn-primary{
        width: 50%;
    }
    p{
        line-height: 36px;
    }

    .div-none{
        display: none;
    }

    .span-text-two{
        margin-left:15%
    }

</style>

<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-pull-left"></a>
    <h1 class="mui-title">能源记录平台</h1>
</header>

<div class="mui-content">

    <div class="mui-card">
        <!--页眉，放置标题-->
        <!--内容区-->
        <div class="mui-card-content">
            <div class="mui-card-content-inner">
                <form class="mui-input-group">
                    <div class="mui-input-row">
                        <label>设备类型</label>
                        <input type="text" class="mui-input-clear" placeholder="电费">
                        <input type="text" class="mui-input-clear div-none" placeholder="类型">
                    </div>
                    <div class="mui-input-row">
                        <label>设备编号</label>
                        <input type="text" class="mui-input-clear" placeholder="XX设备">
                    </div>
                    <div class="mui-input-row">
                        <label>设备描述</label>
                        <input type="text" class="mui-input-clear" placeholder="设备描述">
                    </div>
                    <div class="mui-input-row">
                        <label>设备位置</label>
                        <input type="text" class="mui-input-clear" placeholder="XXBUMENXXXXXXXX">
                    </div>
                    <div class="mui-input-row">
                        <label>采集日期</label>
                        <input id="Time" type="text" class="mui-input-clear"  readonly="readonly" placeholder="选择日期">
                    </div>
                    <div class="mui-input-row">
                        <label>上次读数</label>
                        <input type="text" class="mui-input-clear" placeholder="198">
                    </div>
                    <div class="mui-input-row">
                        <label>本次读数</label>
                        <input type="number" class="mui-input-clear" placeholder="电表读数">
                    </div>
                    <div class="mui-input-row div-none">
                        <label>员工ID</label>
                        <input type="text" class="mui-input-clear" placeholder="员工ID">
                    </div>
                    <div class="mui-input-row div-none">
                        <label>员工姓名</label>
                        <input type="text" class="mui-input-clear" placeholder="员工姓名">
                    </div>



                    <div class="mui-button-row">
                        <button type="button" class="mui-btn mui-btn-primary" >记录</button>
                    </div>
                </form>

                <ul class="mui-table-view">
                    <li class="mui-table-view-cell div-none">
                        <span>name001</span><span class="span-text-two">13-8月 -17</span>
                    </li>
                </ul>

            </div>

        </div>
        <!--页脚，放置补充信息或支持的操作-->

    </div>

</div>


<script>


    $().ready(function () {


        /**
         * 日期选择
         */
        $("#Time").click(function () {

            var dtpicker = new mui.DtPicker({
                type: "datetime",//设置日历初始视图模式
                beginDate: new Date(2017, 06, 01),//设置开始日期
                endDate: new Date(2099, 12, 31),//设置结束日期
                labels: ['年', '月', '日', '时', '分'],//设置默认标签区域提示语
            });

            dtpicker.show(function (items) {
                $("#Time").val(items.value);
            });
        });


        test();

        function test() {
            // 获取的5条参数
            var data = {"code":0,"message":[{"ID":"1CB985FCB48A4BC9A089C433854A2E46","SEQ":4,"STATUS":"A","CREATEDATE":"10-8月 -17","CREATEBY":"张三","CHANGEDATE":"10-8月 -17","CHANGEBY":"张三","FK_ID":"07F7650306494A70AA206951CCFE3229","H23TYPE":"A","H23CODE":"0009","H23DESC":"desc001","H23NUMS":8,"H23DATE":"12-8月 -17","H23EMPID":"empid0001","H23EMPNAME":"name001","H23MEMO":"memo00001"},{"ID":"1CB985FCB48A4BC9A089C433854A2E46","SEQ":3,"STATUS":"A","CREATEDATE":"10-8月 -17","CREATEBY":"张三","CHANGEDATE":"10-8月 -17","CHANGEBY":"张三","FK_ID":"07F7650306494A70AA206951CCFE3229","H23TYPE":"A","H23CODE":"0009","H23DESC":"desc001","H23NUMS":8,"H23DATE":"09-8月 -17","H23EMPID":"empid0001","H23EMPNAME":"name001","H23MEMO":"memo00001"},{"ID":"1CB985FCB48A4BC9A089C433854A2E46","SEQ":2,"STATUS":"A","CREATEDATE":"10-8月 -17","CREATEBY":"张三","CHANGEDATE":"10-8月 -17","CHANGEBY":"张三","FK_ID":"07F7650306494A70AA206951CCFE3229","H23TYPE":"A","H23CODE":"0009","H23DESC":"desc001","H23NUMS":8,"H23DATE":"13-8月 -17","H23EMPID":"empid0001","H23EMPNAME":"name001","H23MEMO":"memo00001"},{"ID":"94C010C8F1244D64ACCD659A93476A6E","SEQ":1,"STATUS":"A","CREATEDATE":"10-8月 -17","CREATEBY":"张三","CHANGEDATE":"10-8月 -17","CHANGEBY":"张三","FK_ID":"fsdfsdgsdgsdgsdg","H23TYPE":"A","H23CODE":"0009","H23DESC":"DESCSDFSDFSDF","H23NUMS":8,"H23DATE":"08-8月 -17","H23EMPID":"empid0001","H23EMPNAME":"name001","H23MEMO":"memo00001"},{"ID":"71171313CB90471EAAAA0D10B00CA5B5","SEQ":0,"STATUS":"A","CREATEDATE":"10-8月 -17","CREATEBY":"张三","CHANGEDATE":"10-8月 -17","CHANGEBY":"张三","FK_ID":"fsdfsdgsdgsdgsdg","H23TYPE":"A","H23CODE":"0009","H23DESC":"DESCSDFSDFSDF","H23NUMS":8,"H23DATE":"08-8月 -17","H23EMPID":"empid0001","H23EMPNAME":"name001","H23MEMO":"memo00001"}]};

            if (data.code == 0 ){

                var num = data.message.length;
                var message  = data.message;

                var list ='';
                for (i=0;i<num;i++){

                    dd = transform(message[i]);
                    list +=
                        '<li class="mui-table-view-cell">'+
                            '<span>'+ dd[14] + '</span>'+
                            '<span class="span-text-two">'+dd[12]+'</span>'+
                        '</li>';
                }
                $('.mui-table-view').append(list);

            }else{
                mui.alert('获取最近五条记录失败');
            }

        }

        function transform(obj){
            var arr = [];
            for(var item in obj){
                arr.push(obj[item]);
            }
            return arr;
        }


//        getLastNum(); //获取最后一条数据

        function getLastNum() {

            // 获取最近一条记录, 用于存储上次电表数
            url =  "<?php echo U('Index/ajax');?>";
            h23code = "<?php echo ($h22code); ?>";
            mui.post(
                url,
                {
                    "code":"APPHA023_5",
                    "h23code":h23code

                },function(data){

                    if (data.code == 0){

                        // 设备类型
                        var type = checkTyepe(data.message[0].H23TYPE);
                        // 写入 数据
                        $('.mui-input-group > .mui-input-row:eq(0) > input:eq(0)').val(type);//设备类型
                        $('.mui-input-group > .mui-input-row:eq(0) > input:eq(1)').val(data.message[0].H23TYPE);//设备类型

                        $('.mui-input-group > .mui-input-row:eq(1) > input').val(data.message[0].H23CODE);//设备编号
                        $('.mui-input-group > .mui-input-row:eq(2) > input').val(data.message[0].H23DESC);//设备描述
                        $('.mui-input-group > .mui-input-row:eq(3) > input').val(data.message[0].H23NUMS);//上次读数

                        $('.mui-input-group > .mui-input-row:eq(7) > input').val(data.message[0].H23EMPID);//员工ID
                        $('.mui-input-group > .mui-input-row:eq(8) > input').val(data.message[0].H23EMPNAME);//员工姓名


                    }
                    else{
                        mui.alert('获取最近一条记录失败');
                    }
                }
            );

        }


        $('.mui-btn-primary').click(function () {

            //保存数据
            saveData();
        });

        // 保存数据
        function saveData() {


            //循环获取数据
            dataArr = forData();
            h23code = $('.mui-input-group > .mui-input-row:eq(9) > input').val();//设备编号

            url =  "<?php echo U('Index/ajax');?>";
            mui.post(
                url,
                {

                    'code':'APPHA023_1',

                    'h23code':dataArr[1],//设备编号
                    'h23desc':dataArr[2],//设备描述

                    'h23date':dataArr[4],//本次时间
                    'h23nums':dataArr[6],//本次读数

                    'h23empid':dataArr[8],//员工ID
                    'h23empname':dataArr[9],//员工姓名
                    'h23type':dataArr[11]//设备类型

                },function(data){

                    if (data.code == 0){
                        mui.alert('保存成功');

                        //获取最近保存的5条记录
                        
                    }else{
                        mui.alert('保存失败,请重试!');
                    }

                },'json'

            );

        }

        // 获取5条参数
        function getFiveData() {

            url =  "<?php echo U('Index/ajax');?>";
            h23code = $('.mui-input-group > .mui-input-row:eq(1) > input').val();//设备编号

            mui.post(
                url,
                {
                    'code':'APPHA023_3',
                    'h23code':h23code

                },function (data) {

                    if (data.code == 0){

                    }else{
                        mui.alert(data.message)
                    }
                }

            );

        }
        

        //循环获取数据
        function forData() {

            var dataArr = Array();

            for (i=0;i<=8;i++){

                dataArr[i] = $('.mui-input-group > .mui-input-row:eq('+i+') > input').val();

                if (dataArr[i] == null || dataArr[i] == '' ){
                    message = $('.mui-input-group > .mui-input-row:eq('+i+') > label').text();
                    mui.alert(message+'不能为空');
                    return;
                }

            }

            // 获取 设备类型
            dataArr[11] = $('.mui-input-group > .mui-input-row:eq(0) > input:eq(1)').val();//设备类型

            if (dataArr[11] == null || dataArr[11] == '' ){
                message = $('.mui-input-group > .mui-input-row:eq(0) > label').text();
                mui.alert(message+'不能为空,请重新获取');
                return;
            }

            return dataArr;
        }


        // 检查设备类型
        function checkTyepe(type) {

            var typeName ='';

            if (type == 'A'){
                typeName = '水费';
            }

            if (type == 'B'){
                typeName = '电费';
            }

            if (type == 'C'){
                typeName = '气费';
            }
            return typeName;
        }


    });

    
    
</script>

</body>
</html>