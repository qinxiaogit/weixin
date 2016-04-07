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
		 * 		 $goodsInfo ->产品信息
		 * 		 $goodsPro	->所属产品ID	
		 * 		 $goodsInfo ->产品简介
		 * */
		public function SetDataToDb($goodsName,$goodsInfo,$goodsPro,$goods_info){
			//addslashes($str)
			if($this->CheckGoodsIsExit($goodsName)){
				return FALSE;
			}
			$data = array("goods_pre_id"=>$goodsPro,"goods_name"=>$goodsName,"goods_info"=>$goodsInfo,"goods_image_name"=>$goods_info);
		
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
				return $data['goods_info'];
			}
			return FALSE;
		 }
		
		
	}
