<?php 
namespace Admin\Model;
use \Think\Model;

class ProductMenuModel	extends Model{
	
	protected $insertFields = 'goods_name,goods_mainifo';	
	//获取所有的产品大类名称
	public function getProductMenu(){
		return $this->select('goods_name');		
	}
	//根据产品的名字获取产品ID
	public function getProductIdToName($goodsname){
		$productInfo = $this->where('goods_name="'.$goodsname.'"')->select();
		
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
	public function AddProductData($ProductName,$ProductDes,$ProductPri){
		
		if(!isset($ProductDes)||!isset($ProductDes)){
			return FALSE;
		}
		try{
			$this->add(array('goods_name'=>$ProductName,'goods_maininfo'=>$ProductDes,'goods_prev_id'=>$ProductPri));
		}catch(\Exception $e){
			/*出现已存在的name时执行下列代码
			$MaxId = $this->max('goods_id');
			ALTER TABLE zytm_product_menu AUTO_INCREMENT =123456
			$sql = "ALTER TABLE ".$this->trueTableName." AUTO_INCREMENT  goods_id=" .$MaxId.";";
			$sql = "ALTER TABLE zytm_product_menu AUTO_INCREMENT = 16";
			$this->query($sql);
			ALTER TABLE zytm_product_menu AUTO_INCREMENT
			 */
			return FALSE;
		}
		// return $this->data($data)->add(); 
		/*
		$dataList[] = array('goods_name'=>$ProductName,'goods_maininfo'=>$ProductDes);
		return 	$this->addAll($dataList);
		 */
		 return TRUE;
	}
	//查询所有产品大类
	public function getAuthId($prid){
		if(isset($prid)){
			return $this->where('goods_prev_id=0')->select();
		}	
		return $this->select();
	}
	//根据产品类的名字获取产品ID
	public function getIDToGoodsName($name){
		
		$goodsInfo = $this->where('goods_name="'.$name.'"')->select();
		return $goodsInfo[0]['goods_id'];
	}	
	
}