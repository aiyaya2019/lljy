$(function() {
    $(".login_msg dl dd").mouseenter(function() {
        $(this).parents().find('a').removeClass('hover');
        $(this).find('a').addClass('hover');
    })
    $(".login_msg").mouseenter(function() {
        $(".login_msg").find('dl').show();
    })
    $(".login_msg").mouseleave(function() {
        $(".login_msg").find('dl').hide();
    })
    $(".tijiao").click(function() {
        var name = $("input[name=name]").val();
        var password = $("input[name=password]").val();
        var code = $("input[name=code]").val();
        if (!name){
          layer.msg('请输入用户名'); return false;
        }
        if (!password) {
          layer.msg('请输入密码'); return false;
        }
        if (!code) {
          layer.msg('请输入验证码'); return false;
        }
	    	var is_index = window.location.pathname.indexOf('index.php');
    		if(is_index>0){
    			  var url = "/index.php/Admin/Login/loginHandel";
    			  var link = "/index.php/Admin/Index";
    		}else{
    			  var url = "/Admin/Login/loginHandel";
    			  var link = "/Admin/Index";
    		}
        $.ajax({
            url:url,
            type:'post',
            data:{
                name:name,
                password:password,
                code:code,
            },
            success:function(rs) {
               if(rs['code']==6){
                  layer.msg('登录成功...');
                  setTimeout(function() {
                     window.location.href = link;
                  },2000);
                  
               }else{
                  layer.msg(rs['msg']);
                  changeCode();
               }
            }
        })
     });
    $('.radio_box').click(function() {
        var type = $(this).find('input').attr('type');
        var name = $(this).find('input').attr('name');
        if (type=="radio") {
            $(this).parents().find("."+name).find('i').removeClass("fa-check-circle");
            $(this).parents().find("."+name).find('i').addClass("fa-circle-thin");
            $(this).find('i').removeClass("fa-circle-thin");
            $(this).find('i').addClass("fa-check-circle");
            $(this).parents('li').find('input[type=radio]').removeAttr('checked');
            $(this).find('input[type=radio]').attr('checked','checked');

          }else{
             var checked = $(this).find('input[type=checkbox]').is(":checked");
             if (checked){
                  $(this).find('i').removeClass("fa-check-circle");
                  $(this).find('i').addClass("fa-circle-thin");
                  $(this).find('input[type=checkbox]').removeAttr('checked');
             }else{
                  $(this).find('i').removeClass("fa-circle-thin");
                  $(this).find('i').addClass("fa-check-circle");
                  $(this).find('input[type=checkbox]').attr('checked','checked');
             }
          }
      });
    $(".back").click(function(){
        history.back();
    })
    //异步删除方法
    $(".table_del").click(function() {
        var link = $(this).attr('link');
        var key = $(this).attr('key');
        var obj = $(this);
        layer.confirm('您确定要删除吗？', {
          btn: ['确定','取消'] //按钮
        },function(){
             $.ajax({
                url:link,
                type:"post",
                data:"id="+key,
                success:function(rs) {
                   if (rs['code']==6){
                      obj.parents('tr').remove();
                      layer.msg(rs['msg']);
                   }else{
                      layer.msg(rs['msg']);
                   }
                }
             })
        },function(){
            layer.closeAll();
        });
    })
})
