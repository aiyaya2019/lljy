<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo C('company_name');?>后台管理</title>
		<link rel="stylesheet" type="text/css" href="/App/Admin/View/Public/css/fontsawesome/css/font-awesome.css" />
		<link rel="stylesheet" type="text/css" href="/App/Admin/View/Public/css/style.css" />
		<script type="text/javascript" src="/App/Admin/View/Public/js/jquery.min.js"></script>
		<script type="text/javascript" src="/App/Admin/View/Public/plug/validate/jquery.validate.min.js"></script>
		<script type="text/javascript" src="/App/Admin/View/Public/plug/layer/layer.js"></script>
		<script type="text/javascript" src="/App/Admin/View/Public/js/js.js"></script>
		<script type="text/javascript" src="/App/Admin/View/Public/js/function.js"></script>
		<link rel="shortcut icon" href="/App/Admin/View/Public/images/favicon.ico" type="image/x-icon" />
	</head>
	<body>
<!-- 内容一 -->
<div class="row" style="margin-top:5rem;">
    <!-- 方块内容 -->
    <div class="tab_content">
        <div class="col-sm-6 col-md-3" id="content-box">
            <!-- 搜索框 -->
            <div class="form-box">
                <div class="time-box">
                    <input class="input-box" name="start_time" value="<?php echo date('Y-m-d', strtotime('-7 days'));?>" onClick="laydate({istime: true,format: 'YYYY-MM-DD'})" />
                    <span class="jiantou"><i class="fa fa-chevron-right"></i></span>
                    <input class="input-box" name="end_time"  value="<?php echo date('Y-m-d');?>" onClick="laydate({istime: true,format: 'YYYY-MM-DD'})" />
                </div>
                <button type="button" class="btn user-btn">确定</button>
            </div>
            <!-- 搜索框end -->
            <div class="col-sm-6 col-md-3">
                <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div id="tab_merchant_count" class="h1 font-w700 text-primary" data-toggle="countTo" data-to=""><?php echo ($tab_arr["tab_merchant_count"]); ?></div>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">新增商户(个)</div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div id="tab_bill_money" class="h1 font-w700 text-success" data-toggle="countTo" data-to="<?php echo ((isset($column) && ($column !== ""))?($column):0); ?>"><?php echo ($tab_arr["tab_bill_money"]); ?></div>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">返利收入(元)</div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- 内容二 -->
<div class="row">
    <!-- 方块内容 -->
    <div class="tab_content">
        <div class="col-sm-6 col-md-3" id="content-box">
            <!-- 搜索框 -->
            <div class="form-box">
                <div class="time-box">
                    <input class="input-box" name="start_time" value="<?php echo date('Y-m-d', strtotime('-7 days'));?>" onClick="laydate({istime: true,format: 'YYYY-MM-DD'})" />
                    <span class="jiantou"><i class="fa fa-chevron-right"></i></span>
                    <input class="input-box" name="end_time"  value="<?php echo date('Y-m-d');?>" onClick="laydate({istime: true,format: 'YYYY-MM-DD'})" />
                </div>
                <button type="button" class="btn user-btn">确定</button>
            </div>
            <!-- 搜索框end -->
            <div class="col-sm-6 col-md-3">
                <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div id="tab_merchant_count" class="h1 font-w700 text-primary" data-toggle="countTo" data-to=""><?php echo ($tab_arr["tab_merchant_count"]); ?></div>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">新增商户(个)</div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3">
                <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div id="tab_bill_money" class="h1 font-w700 text-success" data-toggle="countTo" data-to="<?php echo ((isset($column) && ($column !== ""))?($column):0); ?>"><?php echo ($tab_arr["tab_bill_money"]); ?></div>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">返利收入(元)</div>
                </a>
            </div>
        </div>
    </div>
</div>


<!-- 表格 -->
<div class="col-sm-6 col-md-3" id="content-box" style="background-color:#fff;">
    <div class="block-header bg-gray-lighter" style="border:none;">
        <h3 class="block-title">成交明细</h3>
        <!-- 搜索框 -->
        <div class="table-form">
            <div class="time-box">
                <input class="input-box" name="start_time" value="<?php echo date('Y-m-d', strtotime('-7 days'));?>" onClick="laydate({istime: true,format: 'YYYY-MM-DD'})" />
                <span class="jiantou"><i class="fa fa-chevron-right"></i></span>
                <input class="input-box" name="end_time"  value="<?php echo date('Y-m-d');?>" onClick="laydate({istime: true,format: 'YYYY-MM-DD'})" />
            </div>
            <button type="button" class="btn table-btn">确定</button>
        </div>
        <!-- 搜索框end -->
    </div>
    <div class="table-responsive">
        <table class="table table-builder table-hover table-bordered table-striped js-table-checkable">
            <thead>
                <tr>
                    <th class="column-id ">ID</th>
                    <th class="column-username ">日期</th>
                    <th class="column-group_name ">部门</th>
                    <th class="column-usernum ">业务员</th>
                    <th class="column-nickname ">产品类型</th>
                    <th class="column-nickname ">放贷银行</th>
                    <th class="column-nickname ">客户</th>
                    <th class="column-source ">业务来源</th>
                </tr>
            </thead>
            <tbody class="tbody">
                <tr>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>"><?php echo ($i); ?></td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>"><?php echo (date("Y-m-d H:i:s", $vo["create_time"])); ?></td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>"><?php echo ($vo["group_name"]); ?></td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>"><?php echo ($vo["username"]); ?></td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>"><?php echo ($vo["loantype_name"]); ?></td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>"><?php echo ($vo["bankname"]); ?></td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>"><?php echo ($vo["name"]); ?></td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>"><?php echo ($vo["source"]); ?></td>
                </tr>
                <tr>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                </tr>
                <tr>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                    <td class="<?php echo ((isset($column['class']) && ($column['class'] !== ""))?($column['class']):''); ?>">www</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- 分页 -->
    <div class="row">
        <div class="col-sm-12">
            <ul class="pagination">
                <!-- <li class="disabled"><span>«</span></li> -->
                {for start="1" end="$pages+1"}
                    <li><a href="javascript:void(0);"><?php echo ($i); ?></a></li>
                {/for}
                <!-- <li><a href="/user/index/index.html?page=2">»</a></li> -->
            </ul>
        </div>
    </div>
</div>
<!-- 表格end -->




<div class="row">
    <div class="col-sm-6 col-md-3" id="content-box">
        <!-- 搜索框 -->
        <div class="form-box">
            <div class="time-box">
                <input class="input-box" name="start_time" value="<?php echo date('Y-m-d', strtotime('-7 days'));?>" onClick="laydate({istime: true,format: 'YYYY-MM-DD'})" />
                <span class="jiantou"><i class="fa fa-chevron-right"></i></span>
                <input class="input-box" name="end_time"  value="<?php echo date('Y-m-d');?>" onClick="laydate({istime: true,format: 'YYYY-MM-DD'})" />
            </div>
            <button type="button" class="btn user-btn">确定</button>
        </div>
        <!-- 搜索框end -->

        
        <div class="col-sm-6 col-md-6">
            <div class="block block-bordered" style="padding-left:1%;padding-right:1%;">
                <div class="block-header bg-gray-lighter" style="border:none;">
                    <h3 class="block-title">订单走势</h3>
                </div>
                <div class="tab-head">
                    <ul class="nav nav-tabs assetTypeBox1">
                        <li id="assetNumber1" data-type="0" class="assetType active"><a href="###">金额</a></li>
                        <li id="assetMoney1" data-type="1" class="assetType"><a href="###">数量</a></li>
                    </ul>
                    <div class="btn-group dataTimeBox1" style="margin-top: 0px;">
                        <button type="button" data-time="0" class="btn btn-sm NumberShow btn-primary btn-default">7天</button>
                        <button type="button" data-time="1" class="btn btn-sm NumberShow btn-default">15天</button>
                        <button type="button" data-time="2" class="btn btn-sm NumberShow btn-default">30天</button>
                    </div>
                </div>
                <div class="block block-link-hover3 text-center">
                    <div id="echars1" style="height:360px;padding-top:0" class="block-content block-content-full"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="block block-bordered" style="padding-left:1%;padding-right:1%;">
                <div class="block-header bg-gray-lighter" style="border:none;">
                    <h3 class="block-title">返利总览</h3>
                </div>
                <div class="tab-head">
                    <ul class="nav nav-tabs assetTypeBox2">
                        <li id="assetNumber2" data-type="0" class="assetType active"><a href="###">金额</a></li>
                    </ul>
                    <div class="btn-group dataTimeBox2" style="margin-top: 0px;">
                        <button type="button" data-time="0" class="btn btn-sm NumberShow btn-primary btn-default">7天</button>
                        <button type="button" data-time="1" class="btn btn-sm NumberShow btn-default">15天</button>
                        <button type="button" data-time="2" class="btn btn-sm NumberShow btn-default">30天</button>
                    </div>
                </div>
                <div class="block block-link-hover3 text-center">
                    <div id="echars2" style="height:360px;padding-top:0" class="block-content block-content-full"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        function getTabData() {
            var index = $('.nav-tabs .active').index();
            $.ajax({
                url: '/admin/index/getTabData/tab/' + index,
                type: 'GET',
                async: false,
                success: function(data) {
                    if(data.code) {
                        $('#tab_merchant_count').text(data.data.tab_merchant_count);
                        $('#tab_bill_money').text(data.data.tab_bill_money);
                        $('#tab_order_money').text(data.data.tab_order_money);
                        $('#tab_order_count').text(data.data.tab_order_count);
                    }
                }

            });
        }
        $('.nav-tabs .change-tab').click(function() {
            if($(this).is('.active')) {
                return;
            }
            $(this).addClass('active').siblings().removeClass('active');
            getTabData();
        });
    });
</script>
<script src="/static/__PLUGINS__/echarts/echarts.common.min.js"></script>
<script type="text/javascript">
    $(function(){
        //先初始化图形；
        var myChart1 = echarts.init(document.getElementById('echars1'));
        var myChart2 = echarts.init(document.getElementById('echars2'));
        var option1 = {
            title: {
                text: ''
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data:['']
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: ['周一','周二','周三','周四','周五','周六','周日','周一','周二','周三','周四','周五','周六','周日']
            },
            yAxis: {
                type: 'value'
            },
            color:['#5c90d2'],
            series: [
                {
                    name:'订单走势',
                    type:'line',
                    stack: '总量',
                    data:[120, 132, 101, 134, 90, 230, 210],
                }
            ]
        };
        var option2 = {
            title: {
                text: ''
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data:['']
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            toolbox: {
                feature: {
                    saveAsImage: {}
                }
            },
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: ['周一','周二','周三','周四','周五','周六','周日','周一','周二','周三','周四','周五','周六','周日']
            },
            yAxis: {
                type: 'value'
            },
            color:['#5c90d2'],
            series: [
                {
                    name:'返利总览',
                    type:'line',
                    stack: '总量',
                    data:[120, 132, 101, 134, 90, 230, 210],
                }
            ]
        };
        function setOption1() {
            var type = $('.assetTypeBox1 .active').attr('data-type');
            var time = $('.dataTimeBox1 .btn-primary').attr('data-time');
            $.ajax({
                url: '/admin/index/orderApi',
                type: 'POST',
                data: {type: type, time: time},
                async: false,
                success: function(data) {
                    if(data.code) {
                        option1.xAxis.data = data.data.key;
                        option1.series[0].data = data.data.value;
                        myChart1.setOption(option1);
                    }
                }
            });
        }
        function setOption2() {
            var time = $('.dataTimeBox2 .btn-primary').attr('data-time');
            $.ajax({
                url: '/admin/index/billApi',
                type: 'POST',
                data: {time: time},
                async: false,
                success: function(data) {
                    if(data.code) {
                        option2.xAxis.data = data.data.key;
                        option2.series[0].data = data.data.value;
                        myChart2.setOption(option2);
                    }
                }
            });
        }
        setOption1();
        setOption2();
        $('.assetTypeBox1 .assetType').click(function() {
            if($(this).is('.active')) {
                return;
            }
            $(this).addClass('active').siblings().removeClass('active');
            setOption1();
        });
        $('.dataTimeBox1 .btn-default').click(function() {
            if($(this).is('.btn-primary')) {
                return;
            }
            $(this).addClass('btn-primary').siblings().removeClass('btn-primary');
            setOption1();
        });
        $('.dataTimeBox2 .btn-default').click(function() {
            if($(this).is('.btn-primary')) {
                return;
            }
            $(this).addClass('btn-primary').siblings().removeClass('btn-primary');
            setOption2();
        });
        $(window).resize(function(){
            setOption1();
            $('#echars1').width($(this).parent().outerWidth());
            setOption2();
            $('#echars2').width($(this).parent().outerWidth());
        });

    });
</script>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '<?php echo url("checkUpdate");?>',
            type: 'GET'
        }).done(function(data) {
            $('#product-auth').html(data.auth);
            $('#product-update').html($('#product-update').text() + ' ' + data.update);
        });
    });
</script></body>
</html>