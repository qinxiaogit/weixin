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
           <?php if(is_array($pro_info)): $i = 0; $__LIST__ = $pro_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu_item): $mod = ($i % 2 );++$i;?><li><a href="#"><?php echo ($menu_item["goods_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
           <ul class="nav navbar-nav navbar-right">
        	<li><a style="font-size: 20px;" href="<?php echo U('/Goods/AddProduct');?>">发布新产品</a>
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
                <dic id='main'>
	<div class="edithead">
	<span>编辑管理员信息</span>
	</div>
	<table class="table">
            <thead>
              <tr>
                <th>用户邮箱:</th>
                <th><input id="UserName" type="text" /></th>
                <th id="UserNameInputInfo"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>用登录密码:</th>
                <th><input id="UserPassWd" type="password" /></th>
                <th id="UserPasswdInputInfo"></th>
              </tr>
              </tr>
              <tr>
                <th>权限:</th>
                <th>
                <select id="UserAuth">
					<?php if(is_array($Authlist)): $i = 0; $__LIST__ = $Authlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$auth): $mod = ($i % 2 );++$i;?><option style="width: 175px;"><?php echo ($auth["goods_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						
                </select>
                </th>
              </tr>
              <tr>
                <th>备注信息:</th>
               <th><textarea value="描述管理员权限" id="UserMoreInfo"></textarea></th>
              </tr>
              <tr>
              	<th><button class="btn btn-lg btn-primary" onclick="alterAuth();">确认修改</button></th>
              	
              	
              	<th id="AuthEditInfo"></th>
              </tr>
            </tbody>
        </table>
</diV>
<script>
function alterAuth(){
	var url = "<?php echo U('/User/EditUserInfoToDb/');?>";

	var UserPassWd = $('#UserPassWd').val();
	var UserName  = $('#UserName').val();
	var UserMoreInfo = $('#UserMoreInfo').val();
	var UserAuth = $('#UserAuth').val();
	//判断密码是否为空
	if(UserPassWd==""){
		$('#UserPasswdInputInfo').html('<span style="color:red;">用户密码不能为空</span>');
		return false;
	}
	//判断用户名是否为空
	if(UserName==""){
		$('#UserNameInputInfo').html('<span style="color:red;">用户邮箱不能为空</span>');
		return false;
	}//
	//判断备注是否为空
	if(UserMoreInfo==""){
		UserMoreInfo = "无";
	}
	
	var data = {"UserPassWd":UserPassWd,"UserName":UserName,"UserMoreInfo":UserMoreInfo,"UserAuth":UserAuth};	
	$.ajax({
		type:"post",
		url:url,
		data:data,
		success:function(callbackdata){
			console.log(callbackdata);
			if(callbackdata.RequstStation){
				
				$('#AuthEditInfo').html('<span style="color:green;">'+callbackdata.RequstInfo+'</span>');
			}else{
				$('#AuthEditInfo').html('<span style="color:red;">'+callbackdata.RequstInfo+'</span>');
			}
		},
		error:function(callbackdata){
			console.log(callbackdata);
		}
	});	
	}
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