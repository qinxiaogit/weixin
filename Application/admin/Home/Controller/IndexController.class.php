<?php
namespace Home\Controller;

class IndexController extends CommonController
{
    public function index()
    {
    	$this->display();    
	}
	public function Verify(){  
    	$Verify = new \Think\Verify();  
    	$Verify->fontSize = 18;  
    	$Verify->length   = 4;  
    	$Verify->useNoise = false;  
    	$Verify->codeSet = '0123456789';  //abcdefghijkmnopqrstuvwxyz
    	$Verify->imageW = 130;  
    	$Verify->imageH = 50;  
    	$Verify->expire = 60  ;  
    	$Verify->entry();  
	}
	 
	public function CheckLoginfo(){
		if(CheckVerify()){//验证码验证成功
			
		$user = D('ManageUser');
		$login_email = I('post.login_email');
		
		$loginUserInfo = $user->where("manage_email = '$login_email'")->select(); 	
			
		//print_r($loginUserInfo);	
		
		if(array_key_exists('manage_email',$loginUserInfo[0])){
				
			$passwd = md5(md5(I('post.login_passwd')));
			
			echo $passwd.'<br>';
			echo $loginUserInfo[0]['manage_passwd'].'<br>';
			print_r($loginUserInfo[0]);
			
			
			if($passwd==$loginUserInfo[0]['manage_passwd']){
				$this->error('登录成功',U('Home/Home/'),2);
			}else{
				$this->error('密码错误',U('Home/Index/'),2);
			}
		}else{
			
			$this->error('用户不存在',U('Home/Index/'),2);
		 }
		}else{
			$this->error('验证码错误',U('Home/Index/'),2);
		}	
	}
}