<?php
	namespace Admin\Controller;
	
	class UserController extends CommonController{
		//显示用户信息
		public function Index(){
			
			$user =D('ManageUser');	
			$this->assign('UserInfo',$user->GetAllUserInfo());
			$this->display();
		}
		//删除用户
		public function DelUser(){
			//获取客户端传过来的删除用户信息
			$delUserGroupInfo = I('post.DelUserInfo');	
			//创建用户表操作实例
			$userManage = D('ManageUser');
			
			//判断当前登录用户是否为超级用户		
			//$loginName =cookie('UserName');
			$loginName = cookie('UserName');
			$rootName = $userManage->SelectAdminName();
			$delUserInfo = "";
			//查看当前登录用户是否有权限删除用户
			if($loginName!=$rootName){
				$this->ajaxFailReturn("当前登录用户没有权限删除用户");
			}
			//解析删除数据
			for($i=0;$i<count($delUserGroupInfo);$i++){
				
				//判断删除用户是否为超级用户
				if($delUserGroupInfo[$i]['UserName']==$rootName){
					$delUserInfo = $delUserInfo+":"+$rootName+":超级用户不能删除";	
				}
				//根据当前邮箱查看用户是否存在
				$UserEmail = $userManage->SelectUserNameToEmail($delUserGroupInfo[$i]['UserEmail']);
				if($UserEmail==""){
					$delUserInfo = $delUserInfo+":"+$delUserGroupInfo[$i]['UserName']+"用户信息不存在";
					continue;
				}
				//查看当前删除用户的邮箱和名字是否相等
				if($delUserGroupInfo[$i]['UserName']!=$UserEmail){
						
					$delUserInfo = $delUserInfo+":"+$delUserGroupInfo[$i]['UserName']+"用户信息有误";
					continue;
				}
				//再根据邮箱去删除用户
				if($userManage->DelUser($delUserGroupInfo[$i]['UserEmail'])){
					$delUserInfo = "删除成功";
				}
			}
			$this->ajaxSucceReturn($delUserInfo);
		}
		
		//编辑用户列表展示
		public function EditUserInfo(){
			$ProductClass = D('ProductMenu');
			//获取产品大类
			$data = $ProductClass->getAuthId();
			$this->assign('Authlist',$data);
			
			$this->display();
		}
		//编辑用户权限
		public function EditUserInfoToDb(){
			
			$UserInfo = array("UserName"=>I('post.UserName'),
							  "UserPasswd"=>I('post.UserPassWd'),
							  "UserAuth"=>I('post.UserAuth'),
							  "UserMoreInfo"=>I('post.UserMoreInfo'));
			
			//收到客户端的数据
			if($this->RecvDataHandle($UserInfo)==FALSE){
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
			if(is_array($userStation)){
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
						if($ManageUser->EditUserAuth($UserInfo['UserName'],md5(md5($UserInfo['UserPasswd'])),$Authid)){
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
		$dataTime = time();
		$data = array("manage_name"=>$AddUserName,"manage_role"=>-1,
					  "manage_email"=>$AddUserEmail,"manage_passwd"=>md5(md5($AddUserPassWd)),
					  "manage_create_date"=>$dataTime,"manage_update_date"=>time()
		);	
		
		var_dump($data);
		
		$UserObj = D('ManageUser');
		$this->ajaxSucceReturn($UserObj->AddUser($data));
		if($UserObj->AddUser($data)){
			$this->ajaxSucceReturn("添加用户成功");	
		}else{
			$this->ajaxFailReturn("添加用户失败");
		}
		}
	}
