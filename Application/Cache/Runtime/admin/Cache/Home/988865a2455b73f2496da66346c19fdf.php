<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>成都中亚通茂科技有限公司</title>
	<link type="text/css" href="/weixin/Public/stylesheets/admin/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="/weixin/Public/javascripts/admin/jquery-2.1.1.js" ></script>
	<link type="text/css"  href="/weixin/Public/stylesheets/admin/style.css" rel="stylesheet"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>		
	 <div class="container " >
        <!-- header -->
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
           <?php if(is_array($pro_info)): $i = 0; $__LIST__ = $pro_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu_item): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($key);?>"><?php echo ($menu_item["goods_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
           <ul class="nav navbar-nav navbar-right">
        	<li><a style="font-size: 20px;" href="#about">发布新产品</a>
        		</li>
           </ul>
          </div><!--/.nav-collapse -->
        
      </div>
    </nav>  
    <div class="menu">
    <ul>
        <?php if(is_array($main_menu)): $i = 0; $__LIST__ = $main_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu_item): $mod = ($i % 2 );++$i; if($i == 1): ?><li class="fisrt <?php echo activedLink($key, null, 'fisrt_current');?>">
                	<span><a href="<?php echo U($menu_item['target']);?>"><?php echo ($menu_item['name']); ?></a></span>
                </li>
            <?php elseif($i == count($main_menu)): ?>
                <li class="end <?php echo activedLink($key, null, 'end_current');?>">
                	<span><a href="<?php echo U($menu_item['target']);?>"><?php echo ($menu_item['name']); ?></a></span>
                </li>
            <?php else: ?>
                <li class="<?php echo activedLink($key, null, 'current');?>">
                	<span><a href="<?php echo U($menu_item['target']);?>"><?php echo ($menu_item['name']); ?></a></span>
                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>


<!-- tab -->


<div class="clear"></div>
        <!-- main -->
        <div class="mainBody">
            <!-- left -->
            <div id="Left">
    <div class="subMenuList">
        <div class="itemTitle">
            常用操作
        </div>
        <ul>
            <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu_item): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($key);?>"><?php echo ($menu_item); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>
            <!-- right -->
            <div id="Right">
                <div id="main">
	<div>
	          产品类名:<input type="text" value="" style="width: 350px; height: 30px;" />
	          <div id="addStation" style="display: inline; left: 200px;"></div>
	</div>
	<div>
		产品简介:<textarea value="" style="overflow:auto;" rows="5" cols="50"></textarea>
	</div>
	<button id="btqr" class="btn btn-primary">确认提交</button>
	<button id='btqx' class="btn btn-primary">取消提交</button>
</div> 

<script >
	$(function(){
		$('#btqr').click(function(){
			
			var productName = $('input').val();
			var productDes  = $('textarea').val();
			if(!productDes||!productName){
				alert("产品名称或产品简介不能为空");
				return false;
			}
			//var data = {"productName:"+productName+"","+"productDes:"+productDes};
			//var data=new Array();
			
			//data['productName'] = productName ;
			//var data= productDes;
			var data = {"productName":productName,"productDes":productDes};
			
			var url = "<?php echo U('Home/Goods/AddProductClassToDb');?>";
			$.ajax({
			type:"POST",
			url:url,
			dataType:"json",
			data:data,
			beforeSend:function(){},
			success:function(callbackData){	
			 	//console.log(data);
			 	//console.log(callbackData);
		
			 	if(callbackData.RequstStation){
			 		
			 		$('#addStation').html('<span  style="color: green;size:b5; right: 200px;">'+callbackData.RequstInfo+'</span>');
			 	}else{
			 		
			 		$('#addStation').html('<span  style="color: red;size:b5; right: 200px;">'+callbackData.RequstInfo+'</span>');
			 	}
          	 }
			,
		error:function(callbackData){
			//console.log(callbackData);
			
		}
		
		});
		
		})
		
		
		
		$('#btqx').click(function(){
			window.location = "<?php echo U('Home/Home');?>";
		});
		
	})
	
	
	
</script>
            </div>
        </div>
        <div class="clear"></div>
        <!-- footer -->
        <div class="navbar-fixed-bottom center" > © 2015 xiao-qin，公司地址：<a target="_blank" href="http://zytm913.com" target="_blank" >中亚通茂科技有限公司.成都西部智谷A区1栋1单元五楼</a>
</div>
    </div>
 <script type="text/javascript" src="/weixin/Public/javascripts/admin/admin.js" ></script>
</body>
</html>