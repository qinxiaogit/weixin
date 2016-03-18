<?php
	namespace Home\Model;
	use \Think\Model;
	
	class GoodsModel extends Model{
		
		//默认goods_id的为大类产品 获取权限列表
		public function getAuthId(){	
			$this->where('goods_id')->select();
		}
		//获取产品总数
		public function getProductCount(){
			return $this->where()->count(); 
		}
		//获取某类数据
		//获取数据库分页数据
		public function getPageInfo($PageCount,$ProductCount){
			
			return  $this->page($PageCount,$ProductCount)->select();
			
		}
		//获取某类产品的信息
		
		
	}
