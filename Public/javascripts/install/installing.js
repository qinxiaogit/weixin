
$(function(){
//页面加载完毕，去除邮箱地址后面的html代码

$('#install_create').hover(
	//鼠标移入该元素产生效果
	function(){
		$('#install_create').removeClass('btn_old');
		$('#install_create').toggleClass('btn');
	},function(){
		$('#install_create').removeClass('btn');
		$('#install_create').toggleClass('btn_old');
	});
	
$('#install_pri').hover(
	//鼠标移入该元素产生效果
	function(){
		$('#install_pri').removeClass('btn_old');
		$('#install_pri').toggleClass('btn');
	},function(){
		$('#install_pri').removeClass('btn');
		$('#install_pri').toggleClass('btn_old');
	});


//当第二次输入密码时——失去焦点时 检测两次数据库密码
$('#qr_manager_pwd').focusout(function(e){
	var two_mp = $('#qr_manager_pwd').val();
	var one_mp = $('#J_manager_pwd').val();
	if((two_mp != one_mp)&&(two_mp!=""&&one_mp!="")){
		$('#J_install_tip_admin_password').html('<span for="dbname" generated="true" class="tips_error" style="" id="mm">两侧输入的密码不一致</span>');
		$('#J_install_tip_admin_confirm_password').html('<span for="dbname" generated="true" class="tips_error" style="" id="qrmm">两侧输入的密码不一致</span>');
		$('#qr_manager_pwd').val('');
		$('#J_manager_pwd').val("");
	}
});

//获得焦点时消除密码不一致的提示
$('#qr_manager_pwd').focusin(function( e){
		//alert("焦点移入事件")
	if($('#qr_manager_pwd').val()==="" ){
		$('#mm').html("");
		$('#qrmm').html("");	
	}
});

$('#J_manager_pwd').focusin(function( e){
	if($('#J_manager_pwd').val()==="" ){
		$('#mm').html("");
		$('#qrmm').html("");	
	}
});

$('#install_create').click(function(e){
	//检查数据库信息
	CheckDbPwd();
	//检测邮箱
	emailCheck();
	
	if($("#emailText").val()===""){
		alert('邮箱地址不能为空');
		$('#J_install_tip_admin_email').html('<span for="dbname" generated="true" class="tips_error" style="">邮箱地址不能为空</span>');
		return false;
	}else if($('#dbname').val()===""){
		$('#J_install_tip_db_name').html('<span for="dbname" generated="true" class="tips_error" style="">数据库名不能为空</span>');
		return false;
	}else if($('#webtitle').val()===""){
		$('#J_install_tip_site_title').html('<span for="dbname" generated="true" class="tips_error" style="">标题不能为空</span>');
		return false;
	}
	
	$('#J_install_form').onsubmit();
	
	return true;
});

}
);


//检测数据库连接情况
function CheckDbPwd(){
	var dbHost = $('#dbhost').val();
	var dbPort = $('#dbport').val();
	var dbName = $('#username').val();
	var dbPwd  = $('#dbpw').val();

	var url =  "checkDbConnect";
	var data = { 'db[host]':dbHost,
             'db[username]':dbName,
             'db[password]':dbPwd,
             'db[port]':dbPort 
           };   
	$.ajax({
		type: 'POST',
	 	url: url,
	 	data:data,
		beforeSend: function() { },
        success: function(status) {
            if(!status){
                $('#dbpw').val("");
                $('#J_install_tip_db_password').html('<span for="dbname" generated="true" class="tips_error" style="">数据库链接配失败或者密码错误</span>');
            }else{
            	$('#J_install_tip_db_password').html('');
            }
        },
        complete: function() {},
        error: function(){
            $('#J_install_tip_db_password').html('<span for="dbname" generated="true" class="tips_error" style="">数据库链接配失败或者密码错误</span>');
            $('#dbpw').val("");
        }
   });
  }

function emailCheck()
{
	if($("#emailText").val()===""||$("#emailText").val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
		$('#J_install_tip_admin_email').html('');
	}else{
		$('#J_install_tip_admin_email').html('<span for="dbname" generated="true" class="tips_error" style="">邮箱格式不正确</span>');	
		$("#emailText").val()="";
	}
}

	
    




