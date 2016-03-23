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
			
			$UserInfo = array("UserName"=>I('post.UserName'),
							  "UserPasswd"=>I('post.UserPassWd'),
							  "UserAuth"=>I('post.UserAuth'),
							  "UserMoreInfo"=>I('post.UserMoreInfo'));
			
			//收到客户端的数据
			if(!$this->RecvDataHandle($UserInfo)){
				$this->ajaxFailReturn("用户信息不存在,不能修改权限");
			}
			$this->ajaxSucceReturn("管理员信息修该成功");
		}
		//接收到客户端管理员编辑信息，处理逻辑
		private function RecvDataHandle(array $UserInfo){
			//实例化ManageUser表管理对象
			$ManageUser = D('ManageUser');
			$userStation = $ManageUser->UserIsExisit($UserInfo['UserName']);
			//用户存在->判断是否为超级管理员,
			if($userStation){
				//该用户是超级管理员-》不能修改权限
				if($userStation[0]['manage_role']==0){
					$this->ajaxFailReturn("不能修改超级管理员权限");
				}else{
					//不是超级用户-》判断当前登录用户是否为超级用户
					$loginUserName = cookie('UserName');
					//查询超级用户的name
					if($loginUserName!=$ManageUser->SelectAdminName()){
						$this->ajaxFailReturn("当前登录用户不是超级管理员,不能修改管理员权限");
					}else{
						//修改用户权限-》获取权限ID
						$product = D('ProductMenu');
						//获取产品类ID
						$Authid = $product->getIDToGoodsName($UserInfo['UserAuth']);
						//修改数据库信息
						if($this->EditUserAuth($UserInfo['UserName'],md5(md5($UserInfo['UserPassWd'])),$Authid)){		
							return TRUE;
						}
					}	
				}
			}
			//用户不存在
			return FALSE;
		}
	//新增管理员
	public function AddManage(){
		
		$AddUserName = I('post.user_name');
		$AddUserEmail= I('post.user_email');
		$AddUserPassWd=I('post.user_passwd');
		
		
		if(!isset($AddUserEmail)||$AddUserEmail==""){
			$this->ajaxFailReturn("添加用户失败");
			return FALSE;
		}
		
		$data = array("manage_name"=>$AddUserName,"manage_role"=>-1,
					  "manage_email"=>$AddUserEmail,"manage_passwd"=>md5(md5($AddUserPassWd)),
					  "manage_create_date"=>time(),"manage_update-date"=>time()
		);	
		
		$UserObj = D('ManageUser');
		
		if($UserObj->AddUser($data)){
			$this->ajaxSucceReturn("添加用户成功");	
		}else{
			$this->ajaxFailReturn("添加用户失败");
		}
		 
		}
	}
