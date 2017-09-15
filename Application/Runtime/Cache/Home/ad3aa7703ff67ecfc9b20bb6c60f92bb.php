<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0,user-scalable=0" />
    <link href="/Public/mui/css/mui.min.css" rel="stylesheet">
    <script src="/Public/bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="/Public/mui/js/mui.min.js"></script>
    <script src="/Public/web/js/dingtalk1.6.9.js"></script>
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
                        <input type="text" class="mui-input-clear" id="type" placeholder="电费">
                        <input type="text" class="mui-input-clear div-none" id="h23type" placeholder="类型">
                    </div>
                    <div class="mui-input-row">
                        <label>设备编号</label>
                        <input type="text" class="mui-input-clear" id="h23code" placeholder="XX设备">
                    </div>
                    <div class="mui-input-row">
                        <label>设备描述</label>
                        <input type="text" class="mui-input-clear" id="h23desc" placeholder="设备描述">
                    </div>

                    <div class="mui-input-row">
                        <label>设备位置</label>
                        <input type="text" class="mui-input-clear" placeholder="XXBUMENXXXXXXXX">
                    </div>
                    <div class="mui-input-row">
                        <label>采集日期</label>
                        <input id="h23date" type="text" class="mui-input-clear"  readonly="readonly" placeholder="选择日期">
                    </div>
                    <div class="mui-input-row">
                        <label>上次读数</label>
                        <input type="text" class="mui-input-clear" id="h23nums" placeholder="198">
                    </div>
                    <div class="mui-input-row">
                        <label>本次读数</label>
                        <input type="number" class="mui-input-clear" placeholder="电表读数">
                    </div>
                    <div class="mui-input-row div-none">
                        <label>员工ID</label>
                        <input type="text" class="mui-input-clear" id="H23EMPID" placeholder="员工ID">
                    </div>
                    <div class="mui-input-row div-none">
                        <label>员工姓名</label>
                        <input type="text" class="mui-input-clear" id="H23EMPNAME" placeholder="员工姓名">
                    </div>

                    <div class="mui-input-row div-none">
                        <label>设备ID</label>
                        <input type="text" class="mui-input-clear" id="id" placeholder="员工姓名">
                    </div>

                    <div class="mui-button-row">
                        <button type="button" class="mui-btn mui-btn-primary" >记录</button>
                    </div>
                </form>

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
        $("#h23date").click(function () {

            var dtpicker = new mui.DtPicker({
                type: "datetime",//设置日历初始视图模式
                beginDate: new Date(2017, 06, 01),//设置开始日期
                endDate: new Date(2099, 12, 31),//设置结束日期
                labels: ['年', '月', '日', '时', '分'],//设置默认标签区域提示语
            });

            dtpicker.show(function (items) {
                $("#h23date").val(items.value);
            });
        });


        getLastNum(); //获取最后一条数据

        function getLastNum() {

            // 获取最近一条记录, 用于存储上次电表数
            url =  "<?php echo U('Index/ajax');?>";
            h23code = "<?php echo ($h22code); ?>";

            $.post(
                url,
                {
                    "code":"APPHA023_5",
                    "h23code":h23code

                },function(data){

                    if (data.code == 0){

                        setData = data.message[0];

                        idArr = new Array('h23code','h23desc','h23date','h23nums','h23empid','h23empname','k_id','h23type');

                        // 设备类型
                        var type = checkTyepe(setData.H23TYPE);
                        // 写入 数据
                        $('#id').val(setData.ID);//设备ID
                        $('#type').val(type);//设备类型
                        $('#h23type').val(setData.H23TYPE);//设备类型

                        $('#seq').val(setData.SEQ);//设备类型

                        $('#h23code').val(setData.H23CODE);//设备编号
                        $('#h23desc').val(setData.H23DESC);//设备描述
                        $('#h23nums').val(setData.H23NUMS);//上次读数

                        $('#h23empid').val(setData.H23EMPID);//员工ID
                        $('#h23empname').val(setData.H23EMPNAME);//员工姓名
                        $('#h23date').val(setData.H23DATE);//采集时间


                    }
                    else{
                        mui.alert('获取最近一条记录失败');
                    }
                },'json'
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


            console.log(dataArr);
            return;

            url =  "<?php echo U('Index/ajax');?>";
            mui.post(
                url,
                {
                    'code':'APPHA023_1',

                    'h23code':dataArr[1],//设备编号
                    'h23desc':dataArr[2],//设备描述

                    'h23date':dataArr[4],//本次时间
                    'h23nums':dataArr[6],//本次读数

                    'h23empid':dataArr[7],//员工ID
                    'h23empname':dataArr[8],//员工姓名
                    'k_id':dataArr[9], //设备ID
                    'h23type':dataArr[11]//设备类型

                },function(data){

                    if (data.code == 0){
                        mui.alert('保存成功');

                        //获取最近保存的5条记录
                        getFiveData();
                        
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

            );

        }
        

        //循环获取数据
        function forData() {

            var dataArr = new Array();

            idArr = new Array('h23code','h23desc','h23date','h23nums','h23empid','h23empname','id','h23type');

            for (i=0;i<idArr.length;i++){

                dataArr[i] = $('#'+idArr[i]).val();

                if (dataArr[i] == '' || dataArr[i] == undefined ){
                    dataArr[i] = $('#'+idArr[i]).text();
                }

                if (dataArr[i] == '' || dataArr[i] == undefined ){
                    mui.alert(idArr[i]+'为空');
                    return false;
                }

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

        // 对象转数组
        function transform(obj){
            var arr = [];
            for(var item in obj){
                arr.push(obj[item]);
            }
            return arr;
        }


    });

    
    
</script>

</body>
</html>