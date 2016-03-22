<?php
	namespace Home\Controller;
	
	class UserController extends CommonController{
		//显示用户信息
		public function Index(){
			
			$user =D('ManageUser');
			
			$this->assign('UserInfo',$user->GetAllUserInfo());
			
			$this->display();
		}
	
		public function EditUserInfo(){
			$ProductClass = D('ProductMenu');
			//获取产品大类
			$data = $ProductClass->getAuthId();
			$this->assign('Authlist',$data);
			
			$this->display();
		}
		
		public function EditUserInfoToDb(){
			$UserName = I('post.UserName');
			$UserPasswd = I('post.UserPassWd');
			$UserAuth = I('post.UserAuth');
			$UserMoreInfo = I('post.UserMoreInfo');
			//收到客户端的数据->
			
			$this->ajaxSucceReturn($UserName);
		}
		
		
	}
