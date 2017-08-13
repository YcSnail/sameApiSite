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
<title>访客通行</title>

<style>
    .mui-btn-primary{
        width: 50%;
    }
    p{
        color: #000000;
        line-height: 36px;
    }
</style>

<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-pull-left"></a>
    <h1 class="mui-title">访客通行</h1>
</header>

<div class="mui-content">


    <div class="mui-card">
        <!--页眉，放置标题-->
        <!--内容区-->
        <div class="mui-card-content">
            <div class="mui-card-content-inner">
                <form class="mui-input-group">

                    <div class="mui-input-row">
                        <label>门禁编号</label>
                        <input type="text" class="mui-input-clear" readonly="readonly" placeholder="门禁编号" value="<?php echo ($h22code); ?>">
                    </div>
                    <div class="mui-input-row">
                        <label>姓名</label>
                        <input type="text" class="mui-input-clear" placeholder="请输入姓名">
                    </div>
                    <div class="mui-input-row">
                        <label>公司</label>
                        <input type="text" class="mui-input-clear" placeholder="请输入公司">
                    </div>
                    <div class="mui-input-row">
                        <label>电话</label>
                        <input type="text" class="mui-input-clear" placeholder="请输入电话">
                    </div>
                    <div class="mui-input-row">
                        <label>到访日期</label>
                        <input id="Time" type="text" class="mui-input-clear" readonly="readonly" placeholder="选择日期">
                    </div>
                    <div class="mui-input-row">
                        <label>随行人数</label>
                        <input type="number" class="mui-input-clear" placeholder="请输入随行人数">
                    </div>
                    <div class="mui-input-row">
                        <label>车辆</label>
                        <input type="number" class="mui-input-clear" placeholder="请输入车辆">
                    </div>
                    <div class="mui-input-row">
                        <label>拜访人</label>
                        <input type="text" class="mui-input-clear" placeholder="请输入拜访人">
                    </div>
                    <div class="mui-input-row" style="height: 100px;">
                        <label>备注</label>
                        <textarea id="textarea" rows="5" placeholder="请输入备注"></textarea>
                    </div>

                    <div class="mui-button-row">
                        <button type="button" class="mui-btn mui-btn-primary" >确认</button>
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

        var h22code = $('.mui-input-group > .mui-input-row:eq(0) > input').val();

        if ( h22code == null || h22code == ''){
            mui.alert('门禁编号不能为空');
            return;
        }

        $('.mui-btn-primary').click(function () {

            var h22empname = $('.mui-input-group > .mui-input-row:eq(7) > input').val();

            // 获取 拜访人信息
            url =  "<?php echo U('Index/ajax');?>";
            mui.post(
                url,
                {
                    'code':'EmpValidate',
                    'gname':h22empname

                },function(data){

                    //  var data = { "code": 0,"message": {"GTEL": "18888888888","GUSER": "SZHANG"} };
                    if (data.code != 0){
                        mui.alert('未查询到拜访人信息');
                        return;
                    }

                    // 保存数据
                    saveData(data.message.GTEL);
                },'json'

            );


        });


        // 保存数据
        function saveData(tel) {

            var h22code = $('.mui-input-group > .mui-input-row:eq(0) > input').val();

            if ( h22code == null || h22code == ''){
                mui.alert('门禁编号不能为空');
                return;
            }

            //循环获取数据
            dataArr = forData();

            url =  "<?php echo U('Index/ajax');?>";
            mui.post(
                url,
                {
                    'code':'APPHA022_1',
                    'h22name':dataArr[0],
                    'h22company':dataArr[1],
                    'h22tel':dataArr[2],
                    'h22visitdate':dataArr[3],
                    'h22peoplecnt':dataArr[4],
                    'h22vehicleno':dataArr[5],
                    'h22empname':dataArr[6], // 拜访人姓名
                    'h22memo': dataArr[7],
                    'h22emptel':tel, // 拜访人手机号
                    'h22code':h22code
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
            for (i=1;i<9;i++){

                if (i ==8 ){
                    dataArr[i] = $('.mui-input-group > .mui-input-row:eq('+i+') > textarea').val();
                }else{
                    dataArr[i] = $('.mui-input-group > .mui-input-row:eq('+i+') > input').val();
                }

                if (dataArr[i] == null || dataArr[i] == '' ){
                    message = $('.mui-input-group > .mui-input-row:eq('+i+') > label').text();
                    mui.alert(message+'不能为空');
                    return;
                }

            }
            return dataArr;
        }

    });

</script>

</body>
</html>