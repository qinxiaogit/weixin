<?php
namespace install\Controller;

class IndexController extends CommonController
{
	public function _after_index(){
		
		//echo "后置操作.</br>";
	}
	
	public function _before_index(){
		//echo "前置操作<br/>";
	}
	public function _empty($name){
		echo "当前城市".$name;
	}
    public function index()
    {
    	$this->display();
        //$this->show('成都中亚通茂科技有限公司');
       //重定向到指定的URL地址
	   //redirect('http://www.baidu.com', 5, '页面跳转中...');
       //$this->redirect('CheckEnv/Index','', 5, '页面跳转中...');
       //$this->success("加载成功",U('Index/SayHello'),10)
    }
}