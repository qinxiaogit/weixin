<?php
	namespace Home\Controller;
	use Think\Controller;
	use Home\Logic;
	
	class GoodsDisplayController extends Controller{
		
		Public function Index(){
			//找出所有产品类--
			$goodsclass = new \Think\Model('ProductMenu','zytm_','mysql://root:@localhost/test#utf8');
			//查询类下的大类
			//select * from 表明 order by rand() limit 0,5;
			$goodinfo = $goodsclass->select();
			//随机查出10个产品，进行展示		
			//$goods->	
			$dsn = 'mysql:dbname=test;host=localhost;port=3306';
	        $username = 'root';
	        $password = '';
	        $db=new \PDO($dsn, $username, $password);
			$db->query("SET NAMES utf8");
	        $sql="select goods_name,goods_info,goods_preview_image_path from zytm_Goods order by rand() limit 0,5";
	        $prepare=$db->prepare($sql);
	        $prepare->execute();//添加条件数据
	        $table = $prepare->fetchAll();
			
			$this->assign('goodstable',$table);
			//$this->assign('url',WEB_ROOT.'Public/Uploads/'.$table['goods_preview_image_path']);
			$this->assign('goods',$goodinfo);
			$this->display();
		}
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
			if(!empty($goodsClassName)){
				$goodsId = $goodclass->getGoodsClassIdToGoodsName($goodsClassName);
			}
			//获取子类 
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
			return $childClass ;
		}
		//设置某个产品类下的所有产品到页面
		private function SetGoodsInfo($GoodsclassName=""){
			//未设置产品类，随机从产品类中抓取几条产品信息
			$goodclass = new \Home\Logic\DisplayGoodsClassLogic("product_menu","goods");
			
			$this->assign('goodstable',$goodclass->GetRandGoods($GoodsclassName,10));
			
		}
	
		public function goodsDisplay(){
			$this->SetGoodsPageHeader(I('get.GoodsClass'));
			$this->SetGoodsInfo(I('get.GoodsClass'));
			
			$this->display();
		}
		
		public function goodsClassDisplay(){
			$this->SetPageHeader();
			//[1]['child']
			//var_dump($this->GetGoodsData('软件')[1]['child']);
			$this->assign('goodsinfo',$this->GetGoodsData(I('get.GoodsClass')));
			$this->display();
		}
		public function goodsInfo(){
			
			//获取产品页面信息
			$goodclass = new \Home\Logic\DisplayGoodsClassLogic("product_menu","goods");
			
		 	$this->assign('goodsinfo',$goodclass->GetPageInfo(I('get.GoodsName')));
			$this->display();
			
		}
		
	}	
?>