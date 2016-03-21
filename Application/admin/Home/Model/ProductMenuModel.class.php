<?php 
namespace Home\Model;
use \Think\Model;

class ProductMenuModel	extends Model{
	
	protected $insertFields = 'goods_name,goods_mainifo';	
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
	//添加产品类到产品类表中
	/*
	 *支持以值的形式传入，也支持以数组格式传入 
	 */
	public function AddProductData($ProductName,$ProductDes){
		
		if(!isset($ProductDes)||!isset($ProductDes)){
			return FALSE;
		}
		
		try{
			$this->add(array('goods_name'=>$ProductName,'goods_maininfo'=>$ProductDes));
		}catch(\Exception $e){
			
			return FALSE;
		}
		// return $this->data($data)->add(); 
		/*
		$dataList[] = array('goods_name'=>$ProductName,'goods_maininfo'=>$ProductDes);
		return 	$this->addAll($dataList);
		 */
		 return TRUE;
	}
	
	
}