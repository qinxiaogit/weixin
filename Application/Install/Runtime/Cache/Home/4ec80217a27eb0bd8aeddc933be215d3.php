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
            <div class="body0" id='div0'>
	<p class="headtitle">欢迎来到 zytm-wx 服务器端简易的后台安装程序WEB端。</p>
	<textarea class="pact" readonly="readonly">
本软件使用协议

微信公众号建站系统(以下简称zytm-wx) 使用限制 

1、您在使用zytm-wx时应遵守中华人民共和国相关法律法规、您所在国家或地区之法令及相关国际惯例，不将zytm-wx用于任何非法目的，也不以任何非法方式使用zytm-wx。

2、未经商业授权,不得将本软件用于商业用途(企业网站或以盈利为目的经营性网站)，否则我们将保留追究的权力。
有关 zytm-wx 授权包含的服务范围，技术支持等，请参看 http://www.zytm913.com

 zytm-wx  免责声明:

1、利用 zytm-wx 构建的网站的任何信息内容以及导致的任何版权纠纷和法律争议及后果，zytm-wx官方不承担任何责任。

2、 zytm-wx 损坏包括程序的使用(或无法再使用)中所有一般化,特殊化,偶然性的或必然性的损坏(包括但不限于数据的丢失,自己或第三方所维护数据的不正确修改,和其他程序协作过程中程序的崩溃等),phpwind官方不承担任何责任。

电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和等同的法律效力。您一旦安装使用 zytm-wx ，即被视为完全理解并接受 本协议的各项条款，在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本授权协议并构成侵权，本公司有权随时终止授权，责令停止损害，并保留追究相关责任的权力。
</textarea>
<form action="<?php echo U('CheckEnv/Index');?>" id='form' method="post">
	<input type="hidden" value=""/>
</form>
</div>
<div class="bottom tac">
	<a href="javascript:;" class="btn_old" id="a1">接 受</a>
  	<a href="javascript:;" class="btn_old" id="a2">不接 受</a>	
</div>
    <script type="text/javascript" src="/weixin/Public/javascripts/install/install.js" ></script>
        </div>
    </div>
    <div class="footer"> &copy; 2016.
    <a href="http://www.zytm913.com" target="_blank">中亚通茂科技有限公司</a>
</div>

</body>
</html>