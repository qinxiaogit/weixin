<?php 
namespace Home\Model;
use \Think\Model;

class ManageUserModel	extends Model{
	//新增用户
	public function AddUser(array $UserInfo){
		//先判断该用户邮箱是否存在
		
			
		if($this->UserIsExisit($UserInfo['manage_email'])){
			//邮箱存在
			print_r($this->UserIsExisit($UserInfo['manage_email']));	
			return FALSE;
		}
		//邮箱不存在，将数据添加到数据库
		
		$this->add($UserInfo);
	
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
	public function EditUserAuth($UserEmail,$passwd,$AuthId){
		$data['manage_role']=$AuthId;
		$data['manage_passwd']=$passwd;
		
		return $this->where('manage_email="'.$UserEmail.'"')->save($data); // 根据条件更新记录
	}
	//根据邮箱判断用户是否存在
	public function UserIsExisit($UserEmail){
			
		$res = $this->where('manage_email="'.$UserEmail.'"')->select();
		if($res){
			return $res;
		}
		return FALSE;
	}
	//查询超级用户的name
	public function SelectAdminName(){
		
		$admin = $this->where('manage_role="0"')->select();
		return $admin[0]['manage_email'];		
	}
	
	
	
	
	
}
