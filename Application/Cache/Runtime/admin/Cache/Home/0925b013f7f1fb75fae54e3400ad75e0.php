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
                <div  id='main'>
	<table class="table">
	<tr>
		<td width="13%">全选/全不选<input type="checkbox" checked="" value="" id="SelectAllBox" onchange="SelectAllCheckBox();"/></td>
		<td>名字</td>
        <td>权限</td>
        <td>邮箱</td>
        <td>编号</td>
		<td>创建时间</td>
        <td>上次登录时间</td> 
        <td>备注</td>
	</tr>
	<?php if(is_array($UserInfo)): $i = 0; $__LIST__ = $UserInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$User): $mod = ($i % 2 );++$i;?><tr>
			<td><input checked="" type="checkbox"/>
			</td>
            <td><?php echo ($User["manage_name"]); ?></td>
            <td><?php echo ($User["manage_role"]); ?></td>
            <td><?php echo ($User["manage_email"]); ?></td>
            <td><?php echo ($User["manage_id"]); ?></td>            
            <td><?php echo ($User["manage_create_date"]); ?></td>
            <td><?php echo ($User["manage_update_date"]); ?></td> 
            <td> <a id="editauth" href="<?php echo U('/Home/User/EditUserInfo');?>">编辑</a></td>     
    	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
 </table>
 <button class="btn btn-primary">删除管理员</button>
<button class="btn btn-primary" onclick="AddManage();">新增管理员</button>
</div>
<div id="light" class="white_content">
	<form class="form-horizontal">
		 <fieldset>
            <legend>配置数据源</legend>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="ds_username">用户名:</label>
                <div class="col-sm-4">
                 <input class="form-control" id="ds_username" type="text" />
                </div>
                <label class="col-sm-2 control-label" for="ds_email">登录邮箱:</label>
                <div class="col-sm-4">
                  <input class="form-control" id="ds_email" type="text" placeholder="@zytm.com"/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="ds_passwd">登录密码:</label>
                <div class="col-sm-4">
                 <input class="form-control" id="ds_passwd" type="password" placeholder="***"/>
                </div>
                <label class="col-sm-2 control-label" for="ds_qrpasswd">确认密码:</label>
                <div class="col-sm-4">
                 <input class="form-control" id="ds_qrpasswd" type="password" placeholder="***"/>
                </div>
               </div>
        </fieldset>     
	</form>  	
	<div id="requstInfo"></div>
  	<button class="btn btn-primary btn-block" id="AddUser" >提交信息</button>
</div> 
<div id="fade" class="black_overlay"> 
</div> 

<script>
//添加管理提交数据到服务器
$(function(){
	//提交数据到服务器
	$('#AddUser').click(function(){
		//获取数据
		var user_name = $('#ds_username').val();
		var user_email = $('#ds_email').val();
		var user_passwd = $('#ds_passwd').val();
		var user_qrpasswd = $('#ds_qrpasswd').val();
		if(user_passwd!=user_qrpasswd){
			$('#requstInfo').html('<span style="color: red;">两次密码不一致</span>');
			return false;
		}
		//判断未输入邮箱和密码的情况
		if(user_name==""||user_email==""||user_passwd==""){
			$('#requstInfo').html('<span style="color: red;">邮箱或者用户名或者密码为空</span>');
			return false;
		}
		//拼接数据
		$data={"user_name":user_name,"user_email":user_email,"user_passwd":user_passwd};
		//将提交数据通过ajax提交给服务器
		$url = "<?php echo U('Home/User/AddManage/');?>";
		$.ajax({
			type:"post",
			url:$url,
			data:$data,
			success:function(callbackdata){
				console.log(callbackdata);
			},
			error:function(callbackdata){
				console.log('失败');
			}
		});
		
	})
})

//添加管理员，弹出Div
function AddManage(){
	document.getElementById('light').style.display='block';
	document.getElementById('fade').style.display='block';
}

function ManageInfo(){
	document.getElementById('light').style.display='none';
	document.getElementById('fade').style.display='none'
	
}

function SelectAllCheckBox(){
	//权限按钮checkbox
	//判断该复选框是否选中
	//$('#CheckBox').is(':checked')
	if(true == $('#SelectAllBox').is(':checked')){
		$('input').each(function(){
			 $(this).prop("checked",true);
		})
	}else{
		$('input').each(function(){
			//设置复选框状态
			 $(this).prop("checked",false);
		})
	}
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