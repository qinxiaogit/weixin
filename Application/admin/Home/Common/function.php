<?php 
	//检测验证码
	function CheckVerify(){		
		$verify = new \Think\Verify();
    	return   $verify->check(I('post.code'));
	}	