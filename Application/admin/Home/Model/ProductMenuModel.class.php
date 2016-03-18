<?php 
namespace Home\Model;
use \Think\Model;

class ProductMenuModel	extends Model{
	//获取所有的产品大类名称
	public function getProductMenu(){
		return $this->select('goods_name');		
	}
	//根据产品的名字获取产品ID
	public function getProductIdToName($goodsname){
		$productInfo = $this->where('goods_name=$goodsname')->select();
		
		return $productInfo[0]['goods_id'];
	}
	//获取产品所有信息
	public function getAllInfo(){
		return $this->select();
	}
	
	
}