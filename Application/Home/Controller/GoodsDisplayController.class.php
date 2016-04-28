<?php
	namespace Home\Controller;
	use Think\Controller;
	use Home\Logic;
	
	class GoodsDisplayController extends Controller{
		
		//设置产品页面头
		private function SetGoodsPageHeader($ClassName=""){
			$goodclass = new \Home\Logic\DisplayGoodsClassLogic("product_menu","goods");
			$goodsId = 0 ;
			if(!empty($ClassName)){
				$goodsId = $goodclass->getGoodsClassIdToGoodsName($ClassName);
			}
			$data = $goodclass->GetClassGoods($goodsId ,5);
			$this->assign('goods',$data);
		}
		private function SetPageHeader($ClassName=""){
			$goodclass = new \Home\Logic\DisplayGoodsClassLogic("product_menu","goods");
			$goodsId = 0 ;
			if(!empty($ClassName)){
				$goodsId = $goodclass->getGoodsClassIdToGoodsName($ClassName);
			}
			$data = $goodclass->GetChildClassGoods($goodsId ,5);
			$this->assign('goods',$data);
		}
		//设置页面数据信息->类+产品预览
		private function GetGoodsData($goodsClassName=""){
			
			$goodclass = new \Home\Logic\DisplayGoodsClassLogic("product_menu","goods");
			$goodsId = 0 ;
			if(empty($goodsClassName)){
				$goodsClassName = $goodclass->RandClassName();
			}
			$goodsId = $goodclass->getGoodsClassIdToGoodsName($goodsClassName);
			//获取子类 
			if(isset($goodsId)){
				//var_dump($goodsId);
				$childClass = $goodclass->GetChildClassGoods($goodsId,5);
				//检测是该类是否为还有子类
				//var_dump($goodsClassName);
				if(sizeof($childClass)){
					foreach($childClass as $key => $value) {
						$childClass[$key]['child']=$this->GetGoodsData($value['goods_name']);
					}
				}else{
					//判断是否有子产品存在
					$childgood = $goodclass->GetChildGoods($goodsId); 
					if(sizeof($childgood)){
						$childClass['goods'] = $childgood ;
					}     
					//无子产品
				}
			}
			return $childClass ;
		}
		//设置某个产品类下的所有产品到页面
		private function SetGoodsInfo($GoodsclassName=""){
			//未设置产品类，随机从产品类中抓取几条产品信息
			$goodclass = new \Home\Logic\DisplayGoodsClassLogic("product_menu","goods");
			
			$this->assign('goodstable',$goodclass->GetRandGoods($GoodsclassName));
			
		}
	
		public function Index(){
			$this->SetGoodsPageHeader(I('get.GoodsClass'));
			$this->SetGoodsInfo(I('get.GoodsClass'));
			$this->assign('title',I('get.GoodsClass'));
			$this->display();
		}
		
		public function goodsClassDisplay(){
			$this->SetPageHeader();
			//[1]['child']
			//var_dump($this->GetGoodsData('软件')[1]['child']);
			$GoodsClass = I('get.GoodsClass');
			
			if(!isset($GoodsClass)){
				$GoodsClass = '天线';
			}
			$data = $this->GetGoodsData($GoodsClass);
			
			$this->assign('title',$GoodsClass);
			$this->assign('goodsinfo',$data);
			$this->display();
		}
		
		public function goodsInfo(){
			
			//获取产品页面信息
			$goodclass = new \Home\Logic\DisplayGoodsClassLogic("product_menu","goods");
			
		 	$this->assign('goodsinfo',$goodclass->GetPageInfo(I('get.GoodsName')));
			$this->assign('title',I('get.GoodsName'));
			$this->display();
			
		}
		
	}	
?>