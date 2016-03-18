<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>成都中亚通茂科技有限公司</title>
    <link rel="stylesheet" href="/weixin/Public/stylesheets/install/install.css" />
    <script type="text/javascript" src="/weixin/Public/javascripts/install/jquery-2.1.1.js" ></script>
</head>
<body>
    <div class="wrap">
        <div class="header">
    <h1 class="logo"><?php echo C('SYSTEM_NAME');?></h1>
    <div class="icon_install">安装向导</div>
    <div class="version">Version <?php echo C('SYSTEM_VERSION');?> by <?php echo C('AUTHOR_NAME');?></div>
</div>

        <div class="section">
            <div class="step">
    <ul>
      <li class="on"><em>1</em>检测环境</li>
      <li class="on"><em>2</em>创建数据</li>
      <li class="current"><em>3</em>完成安装</li>
    </ul>
</div>
<div class="install" id="log">
  <ul id="loginner"></ul>
</div>

<div class="bottom tac">
    <a href="javascript:;" class="btn_old"><img src="/weixin/Public/images/install/loading.gif" align="absmiddle" />&nbsp;正在安装...</a>
</div>
<script type="text/javascript" >


function requestInstallStation(CreateTableValue){	
	var data = <?php echo ($data); ?>;
	var url = "<?php echo U('Installed/CreateTable', array(), '');?>" + "/CreateTableValue/" + CreateTableValue;
	alert(url);
	$.ajax({
		type:"POST",
		url:url,
		dataType:"json",
		data:data,
		beforeSend:function(){},
		success:function(callbackData){	
			 //console.log(callbackData);	 
			 //alert(callbackData.info);
			 if(callbackData.CreateTableValue == '999999'){
                // $('#dosubmit').attr("disabled", false);
                // $('#dosubmit').removeAttr("disabled");
                // $('#dosubmit').removeClass("nonext");
                setTimeout('gonext()', 3000);
            }if(callbackData.CreateTableValue){
                $('#loginner').append(callbackData.info);
				//alert(callbackData.info);
                // 递归
                requestInstallStation(callbackData.CreateTableValue);
            }else{
                // 连接数据库失败或者是创建数据库失败
                alert(callbackData.info);
            }
		},
		error:function(callbackData){
			///alert(1234);
		}
	});
	
}
	
	// 安装完成，跳转到5步
function gonext(){
    window.location.href="<?php echo U('Installed/complete');?>";
}
	
</script>

<script type="text/javascript" src="/weixin/Public/javascripts/install/installed.js" ></script>
        </div>
    </div>
    <div class="footer"> &copy; 2016.
    <a href="http://www.zytm913.com" target="_blank">中亚通茂科技有限公司</a>
</div>

</body>
</html>