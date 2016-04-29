<?php
	namespace Admin\Controller;
	use 	Think\Controller;
	use 	Com\WechatAuth;
	class GoodsController extends CommonController{
	
		//展示某个产品
		public function DisplayProduct(){
			
			layout(FALSE);
			//获取需要展示的产品名称
			//获取产品名称
			$title = I('get.goodsName');
			$this->assign('title',$title);
			//实例化产品表
			$goods = D('Goods');
			//获取产品展示信息
			$goodsinfo = $goods->FindGoodsPage($title);
			$this->assign('goodstitle',$goodsinfo['goods_name']);
			$this->assign('goodsimagename',stripslashes($goodsinfo['goods_image_name']));
			//stripslashes var_dump($goods);die;
			//$this->show(urldecode($goods));
			$this->display();
		}
		//查看产品
		public function  CheckProductInfo(){
			
			$goods = D('Goods'); // 实例化Data数据对象
			$goodCount = $goods->getProductCount();
				
			$page = I('get.page');
			
			$page = !empty($page) ? $page: 1;

   			$pageCount = array();
			for($i=0;$i<=(($goodCount)/10+1-$page);$i++){
				$pageCount[$i] = $page+$i ;
			}
			$this->assign('page',$pageCount);
		
			$this->assign('goodsInfo',$goods->getPageInfo($page,10));
   			$this->assign('pageSta',$pageCount[0]);
			$this->assign('pageEnd',$pageCount[$i-1]);
			
   			$this->display(); // 输出模板
		}
		//添加新产品
		public function AddProduct(){
			$ProductClass = D('ProductMenu');
			//获取产品大类
			$data = $ProductClass->getAuthId();
			$this->assign('Authlist',$data);
			
			$this->display();
		}
		//添加产品类
		public function AddProductClass(){
			$ProductClass = D('ProductMenu');
			//获取产品大类
			$data = $ProductClass->getAuthId();
			$this->assign('Authlist',$data);
			$this->display(); // 输出模板
		}
		
		//添加产品到数据库
		public function AddProductToDb(){
			
			$goodsSimple = I('post.goods_simple');
			$goodsName = I('post.goods_name');
			$goodspro =  I('post.goods_id');
			$method = I('get.method');
			//推送给用户的消息
			$ts_sation= I('ts_station');
			
			
			$goods_priview_html = $_POST['goods_priview_html'];
			
			$goods = D('Goods');
			$goodsmenu = D('ProductMenu');	
			if($goodsName==""||$goodsSimple==""||$goodspro=="" ){
				$this->error("操作失败");
			}
			$goodsId = $goodsmenu->getIDToGoodsName($goodspro);
			$data = array("goods_prev_id"=>$goodsId,"goods_name"=>$goodsName,"goods_info"=>$goodsSimple,"goods_image_name"=>$goods_priview_html);
			
			//判断是否为修改操作
			if($method=="add"){
				$fileinfo = UploadFile();
				if(!$fileinfo){
					$this->error("上传文件失败");
				}
				$file = $fileinfo['savepath'].$fileinfo['savename'];
				$thumb = WEB_ROOT.'Public/Uploads_SN/'.$fileinfo['savepath'].$fileinfo['savename'];
				//CreateImg(WEB_ROOT.'Public/Uploads/'.$file,$thumb);
				CreateImg(WEB_ROOT.'Public/Uploads/'.$file,WEB_ROOT.'Public/Uploads_SN/'.$fileinfo['savepath'],$fileinfo['savename']);
				if($goods->SetDataToDb($goodsName,$goodsSimple,$goodsId,$goods_priview_html,$file)){
					//判断是否推送给用户
					if($ts_sation=="on"){
						//	/* 加载微信SDK $appid, $secret, $token*/
        				$appid = C('APPID');//AppID(应用ID)
        				$token = C('TOKEN'); //微信后台填写的TOKEN
        				$crypt = C('CRYPT'); //消息加密KEY（EncodingAESKey）
        				$secret= C('SECRET');//密钥
        				$wechatAuth = new WechatAuth( $appid,$secret ,$token);
						//上传缩略图资源到微信服务器
						//$medid = $this->UpSourceToWx($wechatAuth, $filename)
						//推送消息到用户    
						$data =	array();				
     					$data['title'] = $goodsName ;
						$data['discription'] = $goodsSimple;
						$data['url'] ='http://zytm913.com'."/weixin/index.php/GoodsDisplay/goodsInfo.html?GoodsName=$goodsName";
						$data['picurl']= 'http://zytm913.com/weixin/Public/Uploads_SN/'.$fileinfo['savepath'].$fileinfo['savename']; ;
     					//$data['url'] = "httl://www.baidu.com";
						//$data['picurl'] = "http://pic1.win4000.com/pic/5/a1/be6d763263.jpg";
						$this->NewGoodsTs($wechatAuth ,$data);
					}
					$this->success("添加产品成功");
				}else{
					$this->error("添加产品失败");
				}
			}else if($method=="edit"){
				
				$fileinfo = UploadFile();
				if($fileinfo){
					$data['goods_preview_image_path'] = $fileinfo['savepath'].$fileinfo['savename'];
					//上传图片成功-》删除原来预览图
					$imagePath = WEB_ROOT.'Public/Uploads/'.$goods->getPrevieImageInfo('goods_name="'.$goodsName.'"');
					//删除原来预览图
					unlink($imagePath);
				}
				$goods->UpdataGoodsInfo($data,'goods_name="'.$goodsName.'"');
				$this->success("更新产品信息成功");
			}
		}


	//发送消息
	protected function NewGoodsTs($wechatAuth,$data){

		$wechatAuth->getAccessToken();
		$user = $wechatAuth->userGet();
		foreach ($user['data']['openid'] as $key => $value) {
			$wechatAuth->sendNewsOnce($value,$data['title'],
											 $data['discription'],
											 $data['url'],
										 	 $data['picurl']
			);
		}	
	}
	//上传资源到微信服务器
	protected function UpSourceToWx($wechatAuth,$filename){

		return $wechatAuth->materialAddMaterial($filename,'thimb');
	}
	
	
	//添加产品类 到数据库
	public function AddProductClassToDb(){
				
			$productName = I('post.productName');
			$productDes  = I('post.productDes');
			$productPri  = I('post.productPri');
			$menu = D('ProductMenu');
			$PriGoodsId = 0 ;
			if($productPri!="顶层产品类"){
				$PriGoodsId = $menu->getProductIdToName($productPri);
			}
			 
			if($menu->AddProductData($productName,$productDes,$PriGoodsId)){
				
				$this->ajaxSucceReturn("操作成功");
			}else{
				
				$this->ajaxFailReturn($productName.":已存在");
			}
		}
		//编辑产品
		public function EditProduct(){
			//获取产品的名称
			$goodsName = I("get.goodsName");
			if(!empty($goodsName)){
			//产品类数据库实例
			$ProductClass = D('ProductMenu');
			//产品数据库实例
			$goodsDb = D('Goods');
			//获取待编辑产品的信息
			$goodsinfo =$goodsDb->getGoodsInfoToName($goodsName);
			if(!$goodsinfo){
				layout(FALSE);
				 header( " HTTP/1.0  404  Not Found" );
                 $this->display( 'Public:goods404' );
				 die;
			}
			
			//设置产品名称
			$this->assign('goodsname',$goodsName);
			//获取产品大类
			$data = $ProductClass->getAuthId();
			$this->assign('Authlist',$data);
				
			//设置产品简介
			$this->assign('goodssimple',$goodsinfo['goods_info']);
			//设置预览效果
			$this->assign('goods_preview',$goodsinfo['goods_image_name']);
			
			$this->display(); // 输出模板	
			
			}else{
				  layout(FALSE);
				  header( " HTTP/1.0  404  Not Found" );
                  $this->display( 'Public:404' );
			}
		}
		//根据产品大类查询出所有子产品
		public function SelectGoods(){
			
			
		}
		
	}


