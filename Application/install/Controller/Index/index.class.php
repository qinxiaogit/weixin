<?php
namespace install\Controller\Index;
use Think\Controller;
class index extends Controller{
	public function _before_run(){
		echo 'before_'.ACTION_NAME.'<br/>';
	}
public function run(){
	echo 'xxxxxxxxxxxxxxxxxxx';
 }
}