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
         <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo C('COMPARE_NAME');?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">	
           <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu_item): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($key);?>"><?php echo ($menu_item); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
           <ul class="nav navbar-nav navbar-right">
        	<li><a style="font-size: 20px;" href="#about">发布新产品</a>
        		</li>
           </ul>
          </div><!--/.nav-collapse -->
        
      </div>
    </nav>
    <div>
	
</div>
     
    
    <script type="text/javascript" src="/weixin/Public/javascripts/admin/admin.js" ></script>
</body>
</html>