<?php
	namespace Home\Logic ;
	/*
	 *该逻辑层主要提供 前端页面数据
	 */
	abstract class CommonLogic{
		
		//M方法获取数据库表操作实例
		protected function getM(){
			return M($this->getModelName());
		}
		//D方法获取表实例
		protected function getD(){
			return D($this->getModelName());
		}
		protected function getModelName(){}
		
		
	}
	