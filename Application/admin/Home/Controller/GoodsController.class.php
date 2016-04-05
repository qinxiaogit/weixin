<?php
	namespace Home\Controller;
	use 	Think\Controller;
	
	class GoodsController extends CommonController{
		
		//查看产品
		public function  CheckProductInfo(){
			
			$goods = D('Goods'); // 实例化Data数据对象
			
			$goodCount = $goods->getProductCount();
			
			$page = I('get.page');
			
			$page = !empty($page) ? $page: 1;

   			$pageCount = array();
			for($i=0;$i<=(($goodCount-$page)/10)+0 ;$i++){
				$pageCount[$i] = $page+$i ;
			}
			$this->assign('page',$pageCount);
			//$this->assign('page',$page);			
			//print_r($goods->getPageInfo(1,10));
			$this->assign('goodsInfo',$goods->getPageInfo(1,10));
   			
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
		//添加产品到数据库
		public function AddProductToDb(){
			
			$Html = I('post.pageInfo');
			$goodsName = I('post.goodsName');
			$goodspro =  I('post.goodsId');
			$goodsInfo = I('post.goodsInfo');
			
			$goods = D('Goods');
			$goodsmenu = D('ProductMenu');
			
			if($Html==""||$goodsName==""||$goodsInfo==""||$goodspro=="" ){
				$this->ajaxFailReturn("失败");
			}
			
			$goodsId = $goodsmenu->getIDToGoodsName($goodspro);
	
			if($goods->SetDataToDb($goodsName,$Html,$goodsId,$goodsInfo)){
				
				$this->ajaxSucceReturn("成功");
			}else{
				$this->ajaxFailReturn("失败");
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
			$ProductClass = D('ProductMenu');
			//获取产品大类
			$data = $ProductClass->getAuthId();
			$this->assign('Authlist',$data);
			
			$this->display(); // 输出模板
		}
		//根据产品大类查询出所有子产品
		public function SelectGoods(){
			
			
		}
		
	}


