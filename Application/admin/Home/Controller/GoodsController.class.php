<?php
	namespace Home\Controller;
	use 	Think\Controller;
	
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
			
			$this->display(); // 输出模板
		}
		/*文件上传支持
		 * 文件上传成功，返回文件的名称
		 */
		private function UploadFile(){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize = 3145728 ;// 设置附件上传大小
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->autoSub = true;
			$upload->subName = array('date','Y-m-d');
			$upload->saveName = time().'_'.mt_rand();
			$upload->rootPath = WEB_ROOT.'Public/Uploads/'; // 设置附件上传根目录
			
			return  $upload->uploadOne($_FILES['goods_image']);
		}
		
		//添加产品到数据库
		public function AddProductToDb(){
			
			$goodsSimple = I('post.goods_simple');
			$goodsName = I('post.goods_name');
			$goodspro =  I('post.goods_id');
			$method = I('get.method');
		
			//过滤引号
			$goods_priview_html =addslashes($_POST['goods_priview_html']);
			
			$goods = D('Goods');
			$goodsmenu = D('ProductMenu');	
			if($goodsName==""||$goodsSimple==""||$goodspro=="" ){
				$this->error("操作失败");
			}
			$goodsId = $goodsmenu->getIDToGoodsName($goodspro);
			$data = array("goods_prev_id"=>$goodsId,"goods_name"=>$goodsName,"goods_info"=>$goodsSimple,"goods_image_name"=>$goods_priview_html);
			
			//判断是否为修改操作
			if($method=="add"){
				$fileinfo = $this->UploadFile();
				if(!$fileinfo){
					$this->error("上传文件失败");
				}
				$fileinfo = $fileinfo['savepath'].$fileinfo['savename'];
				if($goods->SetDataToDb($goodsName,$goodsSimple,$goodsId,$goods_priview_html,$fileinfo)){
					$this->success("添加产品成功");
				}else{
					$this->error("添加产品失败");
				}
			}else if($method=="edit"){
				
				$fileinfo = $this->UploadFile();
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
		//添加产品类 到数据库
		public function AddProductClassToDb(){
				
			$productName = I('post.productName');
			$productDes  = I('post.productDes');
			
			$menu = D('ProductMenu');
			if($menu->AddProductData($productName,$productDes)){
				
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
			$this->assign('goods_preview',stripslashes($goodsinfo['goods_image_name']));
			
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


