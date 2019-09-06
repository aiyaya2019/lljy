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
<div class="header">
    <div class="toplogo">
        <div style="font-size:30px;">龙领教育</div>
        
        <!-- <img src="/App/Admin/View/Public/images/logo.png"/> -->
    </div>
    <div class="nav">
        <ul class="clearfix">
            <li style="width:77px;">
                <i class="fa fa-file-photo-o font_lager"></i>
                <p data-id="banner">轮播图管理</p>
            </li>
            <li>
                <i class="fa fa-video-camera font_lager"></i>
                <p data-id="video">视频管理</p>
            </li>
            <li>
                <i class="fa fa-reorder font_lager"></i>
                <p data-id="order">订单管理</p>
            </li>
            <li>
                <i class="fa fa-users font_lager"></i>
                <p data-id="apply">预约管理</p>
            </li>
            <li>
                <i class="fa fa-users font_lager"></i>
                <p data-id="members">会员管理</p>
            </li>
            <li>
                <i class="fa fa-universal-access font_lager"></i>
                <p data-id="rbac">权限管理</p>
            </li>
            <li>
                <i class="fa fa-cogs font_lager"></i>
                <p data-id="base">系统配置</p>
            </li>
            <!-- <li>
                <i class="fa fa-pie-chart font_lager"></i>
                <p data-id="count">统计管理</p>
            </li> -->
        </ul>
    </div>
    <div class="nav_roll f_left" style="display:none;">
        <div class="f_left">
            <i class="fa fa-caret-left fa-1x"></i>
        </div>
        <div class="f_right">
            <i class="fa fa-caret-right fa-1x"></i>
        </div>
    </div>
    <ul class="login_msg">
        <li><img src="/App/Admin/View/Public/images/headimg.png"/></li>
        <li><?php echo ($_SESSION['admin_name']); ?></li>
        <li><i class="fa fa-chevron-down fa-1x"></i></li>
        <dl>
            <dd><a href="/" target="_bank">返回首页</a></dd>
            <dd><a href="<?php echo U('Index/index');?>">系统首页</a></dd>
            <dd><a href="<?php echo U('Rbac/admin_edit',array('user_id'=>$_SESSION['admin_id']));?>" target="cont_box">修改密码</a></dd>
             <dd><a href="<?php echo U('Index/logout');?>">退出登录</a></dd>
        </dl>
    </ul>
</div>

<div style="display: flex;">
    <div class="main_left">
        <h2><i class="menu_icon fa fa-reorder"></i></h2>
        <ul class="menu">

            <!--系统配置-->
            <li>
                <i class="menu_icon fa fa-cog"></i>
                <a href="javascript:void(0);" data-id="base" data-href="<?php echo U('Base/index');?>">基本配置</a>
            </li>
            <li>
                <i class="menu_icon fa fa-share-alt"></i>
                <a href="javascript:void(0);" data-id="base" data-href="<?php echo U('Share/share');?>">分享配置</a>
            </li>
            <li>
                <i class="menu_icon fa fa-edit"></i>
                <a href="javascript:void(0);" data-id="base" data-href="<?php echo U('Other/other', ['type' => '0']);?>">关于本平台</a>
            </li>
            <li>
                <i class="menu_icon fa fa-edit"></i>
                <a href="javascript:void(0);" data-id="base" data-href="<?php echo U('Other/other', ['type' => '1']);?>">报名说明</a>
            </li>
            <li>
                <i class="menu_icon fa fa-edit"></i>
                <a href="javascript:void(0);" data-id="base" data-href="<?php echo U('Other/other', ['type' => '2']);?>">特权说明</a>
            </li>
            <li>
                <i class="menu_icon fa fa-viacoin"></i>
                <a href="javascript:void(0);" data-id="count" data-href="<?php echo U('Count/count', ['type' => '2']);?>">统计管理</a>
            </li>
            <!--轮播图管理-->
            <li>
                <i class="menu_icon fa fa-server"></i>
                <a href="javascript:void(0);" data-id="banner" data-href="<?php echo U('Banner/banner');?>">轮播图列表</a>
            </li>

            <!--视频管理-->
            <li>
                <i class="menu_icon fa fa-server"></i>
                <a href="javascript:void(0);" data-id="video" data-href="<?php echo U('Video/video_cate');?>">视频分类</a>
            </li>
            <li>
                <i class="menu_icon fa fa-server"></i>
                <a href="javascript:void(0);" data-id="video" data-href="<?php echo U('Video/video');?>">视频列表</a>
            </li>
            <li>
                <i class="menu_icon fa fa-server"></i>
                <a href="javascript:void(0);" data-id="video" data-href="<?php echo U('Video/vip');?>">vip费用</a>
            </li>

            <!--订单管理-->
            <li>
                <i class="menu_icon fa fa-server"></i>
                <a href="javascript:void(0);" data-id="order" data-href="<?php echo U('Order/order');?>">订单列表</a>
            </li>

            <!--学员管理-->
            <li>
                <i class="menu_icon fa fa-server"></i>
                <a href="javascript:void(0);" data-id="apply" data-href="<?php echo U('Apply/apply');?>">预约列表</a>
            </li>


            <!--消耗管理-->
            <li>
                <i class="menu_icon fa fa-user-circle"></i>
                <a href="javascript:void(0);" data-id="rbac" data-href="<?php echo U('Rbac/admin');?>">管理员</a>
            </li>
            <li>
                <i class="menu_icon fa fa-universal-access"></i>
                <a href="javascript:void(0);" data-id="rbac" data-href="<?php echo U('Rbac/role');?>">角色管理</a>
            </li>
            <li>
                <i class="menu_icon fa fa-ticket"></i>
                <a href="javascript:void(0);" data-id="rbac" data-href="<?php echo U('Rbac/node');?>">节点管理</a>
            </li>

            <!--员工管理-->
            <li>
                <i class="menu_icon fa fa-users"></i>
                <a href="javascript:void(0);" data-id="members" data-href="<?php echo U('Members/index');?>">会员列表</a>
            </li>
            <!-- <li>
                <i class="menu_icon fa fa-hard-of-hearing"></i>
                <a href="javascript:void(0);" data-id="members" data-href="<?php echo U('Members/address');?>">地址管理</a>
            </li> -->
            <li>
                <i class="menu_icon fa fa-edit"></i>
                <a href="javascript:void(0);" data-id="members" data-href="<?php echo U('Members/messages');?>">意见反馈</a>
            </li>

        </ul>
    </div>
    <!--left end-->
    <div class="main_right">
        <iframe src="<?php echo U('Index/welcome');?>" id="formid" name="cont_box" frameborder="0" width="100%" height="100%" seamless></iframe>
    </div>
</div>
<!--desktop end-->
<!--javascript include-->
<script src="/App/Admin/View/Public/js/jquery.min.js"></script>
<script src="/App/Admin/View/Public/js/tipSuppliers.js"></script>
<script>
    $(function(){
        $(".nav li:first").trigger("click");
    });
    jQuery("body").jrdek({Mtop:".header",Mleft:".main_left",Mright:".main_right",foldCell:".main_left h2"});
    function pClick(topNav,href){
        $(".clearfix").find("li").find("p[data-id='"+topNav+"']").parents("li").addClass("curr");
        $(".menu").find('li').find("a[data-id!='"+topNav+"']").parents("li").hide();
        $(".menu").find('li').find("a[data-href='"+href+"']").parents("li").addClass("curr");
        $(".main_left").show();
        $("#formid").attr('src',href);
    }
</script>
</body>
</html>