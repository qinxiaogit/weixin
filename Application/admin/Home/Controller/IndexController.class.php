<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller
{
    public function index()
    {
    	$this->display();    
	}

	//验证码操作
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
		//检测用户名和密码
		$UserName = I('post.login_email');
		$UserPasswd = md5(md5(I('post.login_passwd')));
		
		if(CheckUserInfo($UserName,$UserPasswd)){
			$this->success('登录成功',U('Home/Home/'),1);
			cookie('UserName',$UserName);
			cookie('UserPasswd',$UserPasswd);
			
		}else{	
				$this->error('密码错误',U('Home/Index/'),1);
			}
		}else{
			$this->error('验证码错误',U('Home/Index/'),1);
		}	
	}
	
	
}