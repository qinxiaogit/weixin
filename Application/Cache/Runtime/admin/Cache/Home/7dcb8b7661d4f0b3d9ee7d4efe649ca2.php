<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>成都中亚通茂科技有限公司</title>
	<link type="text/css" href="/weixin/Public/stylesheets/admin/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="/weixin/Public/javascripts/admin/jquery-2.1.1.js" ></script>
	<script src="/weixin/Public/stylesheets/admin/bootstrap.min.js"></script>
	<link type="text/css"  href="/weixin/Public/stylesheets/admin/style.css" rel="stylesheet"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
    

       <div class="container">

      <form class="form-signin"  method="post" action="<?php echo U('Home/Index/CheckLoginfo');?>">
        <h2 class="form-signin-heading text-center">中亚微信后台管理</h2>
        <label for="inputEmail" class="sr-only">email</label>
        <input type="email" id="inputEmail" name="login_email"  class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">密码</label>
        <input type="password" name="passwd" id="inputPassword" class="form-control" placeholder="Password" required>
        <input type="text" name="code" id="inputcode" class="form-control" placeholder="验证码" required/>
        <img width="48%" id="yzm" class="left15" height="50" alt="验证码" src="<?php echo U('Home/Index/Verify',array());?>" title="点击刷新">
        <button class="form-control btn-primary" type="submit">登录</button>
        <button class="form-control btn-primary" >忘记密码</button>
      </form>
 </div> <!-- /container -->     
    
    <script type="text/javascript" src="/weixin/Public/javascripts/admin/admin.js" ></script>
</body>
</html>