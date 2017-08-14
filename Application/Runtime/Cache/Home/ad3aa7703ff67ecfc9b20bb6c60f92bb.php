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
                    </div>
                    <div class="mui-input-row">
                        <label>设备编号</label>
                        <input type="text" class="mui-input-clear" placeholder="XX设备">
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
    
    $('.mui-btn-primary').click(function () {

        //保存数据
        saveData();
    });

    // 保存数据
    function saveData() {


        //循环获取数据
        dataArr = forData();

        url =  "<?php echo U('Index/ajax');?>";
        mui.post(
            url,
            {

                'code':'APPHA023_1',
                'h23type':dataArr[0],
                'h23desc':dataArr[1],
                'h23nums':dataArr[2],
                'h23date':dataArr[3]

            },function(data){

                if (data.code == 0){
                    mui.alert('保存成功');
                }else{
                    mui.alert('保存失败,请重试!');
                }

            },'json'

        );

    }

    //循环获取数据
    function forData() {

        var dataArr = Array();

        for (i=0;i<=6;i++){

            dataArr[i] = $('.mui-input-group > .mui-input-row:eq('+i+') > input').val();

            if (dataArr[i] == null || dataArr[i] == '' ){
                message = $('.mui-input-group > .mui-input-row:eq('+i+') > label').text();
                mui.alert(message+'不能为空');
                return;
            }

        }
        return dataArr;
    }
    
    
</script>

</body>
</html>