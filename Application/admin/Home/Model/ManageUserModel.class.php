<?php 
namespace Home\Model;
use \Think\Model;

class ManageUserModel	extends Model{
	//新增用户
	public function AddUser(array $UserInfo){
		try{
			$this->add($UserInfo);
		}catch(\Exception $e){
			//改名字已经存在
			return FALSE;
		}
		return TRUE;
	}
	//删除用户
	public function DelUser($name){
		
		
	}
	//编辑用户
	public function EditUser(){
		
		
	}
	//获取所有用户信息
	public function GetAllUserInfo(){
		//拼接SQL*/
		return $this->select();	
	}
	//修改用户权限
	public function EditUserInfo(){
		
		
	}
	
	
}
