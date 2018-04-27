/**
 * Created by asusa on 2017/3/2/0002.
 */
$(document).ready(function(){
    $("#mySubmit").submit(function(){
    	//alert('ddddd');
        var name = $('#username').val();
        var pass = $('#password').val();
        var action_url = $('form').attr('action');  //验证登录信息
        var data_url = $('#data_url').val();        //成功跳转页面
		alert(name+pass);
		return false;
        if(name == '' || pass == '')
        {
            $(".mess").text('用户名和密码不能为空!');
            $(".mess").fadeIn(0);
            $(".mess").fadeOut(3000);
            return false;
        }
        else
        {
            var bol=true;
            $.ajax({
                type: "POST",
                async:false,    //同步处理,默认true异步
                url: action_url,
                data: {username: name, password: pass},
                success: function (data) {
                    var show = eval('('+data+')');
                    //console.log(data);   //data即为后台返回的数据
                    if(show['status']==300)
                    {
                        $('.mess').text(show['mess']);
                        $(".mess").fadeIn(0);
                        $(".mess").fadeOut(3000);
                        bol = false;
                    }
                    if(show['status']==200)
                    {
                        //$('.mess').text(show['mess']);
                        //alert(data_url)
                        window.location.href=data_url;  //登录成功跳转
                        bol = false;
                    }
                }
            });
            return bol;
        }
    });
});