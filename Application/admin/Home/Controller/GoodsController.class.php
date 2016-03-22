<?php
	namespace Home\Controller;
	use 	Think\Controller;
	
	class GoodsController extends CommonController{
		
		//查看产品
		public function  CheckProductInfo(){
			
			$goods = D('Goods'); // 实例化Data数据对象
			
			$goodCount = $goods->getProductCount();
			   		
   			$pageCount = array();
			for($i=1;$i<=($goodCount/10)+1 ;$i++){
				$pageCount[$i-1] = $i ;
			}
			$this->assign('page',$pageCount);
			
			//print_r($goods->getPageInfo(1,10));
			$this->assign('goodsInfo',$goods->getPageInfo(1,10));
   			
   			$this->display(); // 输出模板
		}
		//添加新产品
		public function AddProduct(){
			
			$this->display();
		}
		
		//添加产品类
		public function AddProductClass(){
			
			$this->display(); // 输出模板
		}
		//添加产品到数据库
		public function AddProductToDb(){
			
			
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
		
	}


