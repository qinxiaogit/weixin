<?php
	namespace Home\Logic;
	use Think\Model;
	//产品类+产品展示
	class DisplayGoodsClassLogic extends CommonLogic{
		
		/*获取某类产品下的所有子类信息
		 * $GoodsClassName:产品类名
		 * $count:获取数据条数
		 */
		//产品菜单表
		private $GoodsMeumTable = "";
		//产品表
		private $GoodsTable = "";
		
		public function  __construct($GoodsMeumTableName="",$GoodsTableName=""){
			if(is_string($GoodsMeumTableName)&&is_string($GoodsTableName)){
				$this->GoodsMeumTable = M($GoodsMeumTableName);
				$this->GoodsTable	 = 	M($GoodsTableName);	
			}
		}
		//获取类产品->子类产品
		public function GetChildClassInfo($GoodsClassName="",$count=5){
			//获取菜单表数据库实例
			if(!isset($GoodsClassName)){
				throw_exception("产品类名为空");
			}	
			if(!is_object($this->GoodsMeumTable)){
				throw_exception("逻辑操作对象产生失败");
			}
			/*var_dump($table->field(C('DB_PREFIX').$this->GoodsMeumTable.'.*',C('DB_PREFIX').$this->GoodsTable.'.*')
						   ->table(C('DB_PREFIX').$this->GoodsMeumTable,C('DB_PREFIX').$this->GoodsTable)
						   ->select());
			 */
			 //获取产品类的ID
			$goodsId = $this->GoodsMeumTable->getFieldByGoodsName($GoodsClassName,'goods_id');
			//获取子类产品Idx
			//$User->where('status=1')->order('create_time')->limit(10)->select();
			return $this->GoodsMeumTable->where('goods_prev_id="'.$goodsId.'"')->limit($count)->select();
		}
		/*
		 *根据产品类名称获取产品Id: 
		 */
		public function getGoodsClassIdToGoodsName($goodsName){
			
			$goodsinfo = $this->GoodsMeumTable->where('goods_name="'.$goodsName.'"')->select();
		 
			return $goodsinfo[0]['goods_id'];	
		 }
		
		
		/*获取某类产品下的所有产品信息
		 * $GoodsClassName:产品子类名
		 * $count:获取数据条数
		 */
		public function GetChildGoods($GoodsClassId,$count="2"){
		
			if(!isset($GoodsClassId)){
				throw_exception("产品类信息为空");
			}	
			if(!isset($this->GoodsMeumTable)){
				throw_exception("逻辑操作对象产生失败");
			}	
			return $this->GoodsTable->where('goods_prev_id="'.$GoodsClassId.'"')->limit($count)->select();
		}
		//获取子产品类
		public function GetChildClassGoods($GoodsClassId,$count="2"){
				if(!isset($GoodsClassId)){
				throw_exception("产品类信息为空");
			}	
			if(!isset($this->GoodsMeumTable)){
				throw_exception("逻辑操作对象产生失败");
			}	
			return $this->GoodsMeumTable->where('goods_prev_id="'.$GoodsClassId.'"')->limit($count)->select();		
		}
		
		
	}
