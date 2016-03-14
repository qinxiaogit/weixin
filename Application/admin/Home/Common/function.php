<?php 
	//检测验证码
	function CheckVerify(){		
		$verify = new \Think\Verify();
    	return   $verify->check(I('post.code'));
	}
	function CheckUserInfo($UserName,$passwd){
			
		$user = D('ManageUser');
		
		$loginUserInfo = $user->where("manage_email = '$UserName'")->select(); 
		
		if(array_key_exists('manage_email',$loginUserInfo[0])){
			if($passwd==$loginUserInfo[0]['manage_passwd']){
				return true;
			}else{
				return false;
			}
		}					
		//用户名不存在
		return flase;
	}