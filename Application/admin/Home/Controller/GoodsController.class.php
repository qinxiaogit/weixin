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
			$goods = $goods->FindGoodsPage($title);
			
			$this->assign('goods',$goods);
			$this->show(urldecode($goods));
			//$this->display('DisplayProduct');
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
			//获取产品的名称
			$goodsName = I("get.goodsName");
			if(isset($goodsName)){
				//获取产品大类
				$data = $ProductClass->getAuthId();
				$this->assign('Authlist',$data);
			
				$this->display(); // 输出模板	
			}
		}
		//根据产品大类查询出所有子产品
		public function SelectGoods(){
			
			
		}
		
	}


