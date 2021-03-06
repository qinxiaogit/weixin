<?php
	namespace Admin\Controller;
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
				$this->getHeadMenu();
				$this->assignMenu(); 	 			
			}
	//产品类列表-pro_info
	protected function getHeadMenu(){
			
		$ProductClass = D('ProductMenu');
			//获取产品大类
		$this->assign('pro_info',$ProductClass->getAuthId(1));	
	}	
	/* 分配菜单
     * @return
     */
    protected function assignMenu() {
        $menu = $this->getMenu();
		    
        $this->assign('sub_menu', $menu);
    }
    /**
     * 得到菜单
     * @return array
     */
    protected function getMenu() {
        $menu = C('MENU');
		
		return $menu;	
	}	
	//获取横向产品菜单
	protected function getProductInfo(){
		
		$proinfo = D('ProductMenu');
		$data = $proinfo->getProductMenu();
		
		$this->assign('pro_info',$data);
	}
	//请求信息返回
	protected function ajaxSucceReturn($info){
		
		$this->ajaxReturn(array("RequstStation"=>TRUE,"RequstInfo"=>$info));
	}
	protected function ajaxFailReturn($info){
		$this->ajaxReturn(array("RequstStation"=>FALSE,"RequstInfo"=>$info));
	}
	
	
		
}
