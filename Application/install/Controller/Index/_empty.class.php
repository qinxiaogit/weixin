<?php
namespace install\Controller\Index;
use Think\Controller;
class _empty extends Controller{
	public function run(){
		echo '执行Index控制器的'.ACTION_NAME.'操作';
	}
}