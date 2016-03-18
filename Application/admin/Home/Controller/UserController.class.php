<?php
	namespace Home\Controller;
	
	class UserController extends CommonController{
		
		public function Index(){
			
			$user =D('ManageUser');
			
			$this->assign('UserInfo',$user->GetAllUserInfo());
			
			$this->display();
		}
	
		public function EditUserInfo(){
			$goods = D('Goods');
			
			$this->assign('Authlist',$goods->getAuthId());
			
			$this->display();
			
		}
		//获取权限列表 ,及大类产品列表
		
		
	}
