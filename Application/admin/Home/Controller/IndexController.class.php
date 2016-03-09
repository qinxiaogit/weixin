<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
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
			
			
		}else{
			$this->error('验证码错误',U('Home/Index/'),2);
		}
		
	}



	
}