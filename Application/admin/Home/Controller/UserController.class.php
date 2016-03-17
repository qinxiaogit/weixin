<?php
	namespace Home\Controller;
	
	class UserController extends CommonController{
		
		public function Index(){
			
			$user =D('ManageUser');
			
			$this->assign('UserInfo',$user->GetAllUserInfo());
			
			$this->display();
		}
		//查询产品大类---反馈产品新信
		private function CheckProduct(){
			
			
		}
		public function EditUserInfo(){
			
			
			$this->display();
			
		}
		//获取权限列表 ,及大类产品列表
		
		
	}
