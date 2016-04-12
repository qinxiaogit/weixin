<?php
	namespace Home\Model;
	use \Think\Model;
	//产品表
	class GoodsModel extends Model{
		
		//默认goods_id的为大类产品 获取权限列表
		//获取产品总数
		public function getProductCount(){
			return $this->where()->count(); 
		}
		//获取某类数据
		//获取数据库分页数据
		public function getPageInfo($PageCount,$ProductCount){
			
			return  $this->page($PageCount,$ProductCount)->select();
			
		}
		/*将产品信息添加到数据库 
		 *param: $goodsName ->产品名字
		 * 		 $goodsInfo ->产品简介
		 * 		 $goodsPro	->所属产品ID	
		 * 		 $goods_Info ->产品描述信息
		 * */
		public function SetDataToDb($goodsName,$goodsInfo,$goodsPreId,$goods_info,$goods_preview_image_path){
			
			if($this->CheckGoodsIsExit($goodsName)){
				return FALSE;
			}
			$data = array("goods_prev_id"=>$goodsPreId,"goods_name"=>$goodsName,"goods_info"=>$goodsInfo,"goods_image_name"=>$goods_info,"goods_preview_image_path"=>$goods_preview_image_path);
			return $this->add($data);
		}
		/*
		 * 检测该产品是否存在
		 */
		public function CheckGoodsIsExit($goodsName){
		
			$data = $this->where('goods_name="'.$goodsName.'"')->find();	
			if(is_array($data)){
				return TRUE;
			}
			return FALSE;
		}
		/*
		 * 查找某个产品展示页面
		 * 
		 */
		 public function FindGoodsPage($goodsName){
		 	$data = $this->where('goods_name="'.$goodsName.'"')->find();	
			if(is_array($data)){
				return $data;
			}
			return FALSE;
		 }
		 /*
		  * 根据产品名字获取产品信息
		  * 以数组的形式进行返回
		  */
		  function getGoodsInfoToName($goodsName){
		  	$data = $this->where('goods_name="'.$goodsName.'"')->find();	
			if(is_array($data)){
				return $data;
			}
			return FALSE;
		  }
		  /*
		   * 更新数据数据信息
		   */
		   function UpdataGoodsInfo(Array $data,$condtion){	
				return $this->where($condtion)->save($data); // 根据条件更新记录
		   }
		   function getPrevieImageInfo($condtion){
		   	 return $this->fetchSql(FALSE)->where($condtion)->getField('goods_preview_image_path');
		   }
		   
		
		
	}
