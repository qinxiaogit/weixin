<?php 
	//检测验证码
	function CheckVerify(){		
		$verify = new \Think\Verify();
    	return   $verify->check(I('post.code'));
	}
	function CheckUserInfo($UserName,$passwd){
			
		$user = D('ManageUser');
		
		$loginUserInfo = $user->where("manage_email = '$UserName'")->select(); 
		
		if(array_key_exists('manage_email',$loginUserInfo[0])){
			if($passwd==$loginUserInfo[0]['manage_passwd']){
				return true;
			}else{
				return false;
			}
		}					
		//用户名不存在
		return flase;
	}
	//检测目录是否存在，不存在则创建
	function CreateDir($path){
		if(isset($path)){
			if(!is_dir($path)){
				mkdir($path);
			}
			return true;
		}
		return false;
	}
	//缩略图生成
    function CreateImg($fileName,$SaveFilePath,$saveFileName){
		$img = new \Think\Image();
		$img->open($fileName);
			
		if(CreateDir($SaveFilePath)){	
			 $img->thumb(640, 480,\Think\Image::IMAGE_THUMB_SCALE)->save($SaveFilePath.$saveFileName);
			return true;
		}
		return FALSE;
	}
		/*文件上传支持
		 * 文件上传成功，返回文件的名称并保存预览图
		 */
	function UploadFile(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 3145728 ;// 设置附件上传大小
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->autoSub = true;
		$upload->subName = array('date','Y-m-d');
		$upload->saveName = time().'_'.mt_rand();
		$upload->rootPath = WEB_ROOT.'Public/Uploads/'; // 设置附件上传根目录
		return  $upload->uploadOne($_FILES['goods_image']);
	}		
	