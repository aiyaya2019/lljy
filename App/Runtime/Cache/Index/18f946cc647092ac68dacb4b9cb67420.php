<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ((isset($title) && ($title !== ""))?($title):getBase('name')); ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="apple-mobile-web-app-title" content="花植素健康护肤">
	<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body>
<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">

    .bank-index>ul>li{display: flex;justify-content: space-between;}
    .bank-index>ul>li>.addmsg>h2{height: 1.8rem;line-height: 1.8rem}
    .bank-index>ul>li>.addmsg>p{height: 0.7rem;line-height: 0.7rem}
    .bank-index>ul>li>.edit{font-size: 0.7rem}
    .bank-index>ul>li>.edit>a{display: block;line-height: 1.7rem}
    .bank-index>ul>li>.edit>div{display: block;line-height: 1.7rem}

.bank-index>ul {
    padding: 0 0.5rem;
    margin-top: 0.5rem;
    list-style-type: none;
}
    .bank-index>ul>li{display: flex;justify-content: space-between;}
    .bank-index>ul>li>.addmsg>h2{height: 1.8rem;line-height: 1.8rem}
    .bank-index>ul>li>.addmsg>p{height: 0.7rem;line-height: 0.7rem}
    .bank-index>ul>li>.edit{font-size: 0.7rem}
    .bank-index>ul>li>.edit>a{display: block;line-height: 1.7rem}
    .bank-index>ul>li>.edit>div{display: block;line-height: 1.7rem}


.bank-index>ul>li{margin-bottom: 0.5rem;height: 4.6rem;color: #fff; border-radius: 0.2rem; background: url(/Public/images/bg_bankcard.jpg);background-size: 100%;padding: 0 0.5rem}
/*.bank-index>ul>li>h2>span{font-size: 0.7rem}*/
.bank-index>ul>li>p{font-size: 0.65rem;height: 1rem;line-height: 1rem;margin-top: 0.5rem}
.bank-index>ul>li>a{font-size: 0.6rem;color: #fff;float: right;position: relative;bottom: 1rem}
.bank-index>a.addbank{display: block;text-align: center;background: #fff;height: 3.5rem;margin: 0 auto;width: 90%;margin-top: 0.5rem;border: 1px dashed #ddd;color: #999; height:5rem; text-decoration:none;}
.bank-index>a.addbank>img{position: relative;top:0.5rem;width: 1.5rem}
.bank-index>a.addbank>p{position: relative;top: 0.5rem;font-size: 0.6rem}

.bank-index>ul>li>h2{height: 1rem;padding-top: 0.8rem;font-size: 0.3rem}
p {
    display: block;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
}


</style>
<content>
    <div class="bank-index">
    	<ul>
    	    <?php if(is_array($data)): foreach($data as $key=>$v): ?><li add_id="<?php echo ($v["id"]); ?>">
                    <div class="addmsg">
                        <h2 style="font-size:0.8rem;">
                            <span><?php echo ($v["username"]); ?></span>&nbsp;<?php echo ($v["userphone"]); ?>
                        </h2>
                        <p style="font-size:0.32rem;"><?php echo ($v["province"]); echo ($v["city"]); echo ($v["area"]); echo ($v["details"]); ?></p>
                    </div>
	    			<div class="edit">
                        <a href="<?php echo U('Me/address_edit',array('id'=>$v['id'],'type'=>$_GET['type']));?>">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <div class="checkAddr" default="1">
                            <?php if($v['default']): ?><i class="fa fa-check-square-o"></i>
                            <?php else: ?>
                               <i class="fa fa-square-o"></i><?php endif; ?>
                        </div>
                    </div>
	    		</li><?php endforeach; endif; ?>
    	</ul>
    	<a class="addbank" href="<?php echo U('Me/address_edit',array('type'=>$_GET['type']));?>">
    		<img src="/Public/images/addbank.png" alt="">
    		<p>添加收货地址</p>
    	</a>
    </div>
</content>
<script type="text/javascript">
    $(function(){
        $(".bank-index>ul>li>.addmsg").click(function(){
            var type = "<?php echo ($_GET['type']); ?>";
            if (type==1){
                var address_id = $(this).parents("li").attr('add_id');
                window.location.href="<?php echo U('Mall/confirm','','');?>?address_id="+address_id;
            }else{
                return true
            }
        })
        $(".checkAddr").click(function() {
            var add_id = $(this).parents('li').attr("add_id");
            $.ajax({
                url:"<?php echo U('Ajax/setDdefaultAdd');?>",
                type:"post",
                data:"id="+add_id,
                success:function(rs) {
                    if (rs['code'] == 6){
                        location.reload();
                    }else{
                        // layer.open({
                        //     content: rs['msg'],
                        //     skin: 'msg',
                        //     time: 2    //2秒后自动关闭
                        // });
                    }
                }
            })
        })
    })
</script>
<script>
  var businessid="0769-DXMP2307908634-7662108670";//行业版或基础版商家id
    var edition=1;//0：基础版，1：行业版；
  var functionid = "dwsqdszj_dzgl";//功能点ID

  var channel="WX";//来源渠道
  var _hmt = _hmt || []; 
  (function() { 
    var hm = document.createElement("script"); 
    hm.src = "https://tongji.114station.com/js/v1/flume.min.js"; 
    var s = document.getElementsByTagName("script")[0]; 
    s.parentNode.insertBefore(hm, s); 
  })();
</script>
</body>
</html>