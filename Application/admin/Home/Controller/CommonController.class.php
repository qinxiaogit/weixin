<?php
	   namespace Home\Controller;
	use Think\Controller ;
	
	class CommonController extends Controller{
		   
		   //检测登录状态
			protected function CheckLoginState(){
					
					$loginName =cookie('UserName');
					$loginPasswd = cookie('UserPasswd');//function 	
					
					if(!isset($loginName)){
						return false;
					}
				return CheckUserInfo($loginName,$loginPasswd);
			}
			
		    public function _initialize() {
        		 header('Content-Type: text/html; charset=UTF-8');
				if(!$this->CheckLoginState()){
				  header("location: http://localhost/weixin/admin.php");
				}   	 			
			}
			
	}
