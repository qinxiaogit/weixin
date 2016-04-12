<?php
	namespace Home\Controller;
	use Think\Controller;

	class GoodsDisplayController extends Controller{
		
		Public function Index(){
			//找出所有产品类--
			$goodsclass = new \Think\Model('ProductMenu','zytm_','mysql://root:@localhost/test#utf8');
			//查询所有的大类
			//select * from 表明 order by rand() limit 0,5;
			$goodinfo = $goodsclass->select();
			//随机查出10个产品，进行展示
			
			//$goods->
		
			$dsn = 'mysql:dbname=test;host=localhost;port=3306';
	        $username = 'root';
	        $password = '';
	        $db=new \PDO($dsn, $username, $password);
			$db->query("SET NAMES utf8");
	        $sql="select goods_name,goods_info from zytm_Goods order by rand() limit 0,5";
	        $prepare=$db->prepare($sql);
	        $prepare->execute();//添加条件数据
	        $table = $prepare->fetchAll();
	        
			$this->assign('goodstable',$table);
	
			$this->assign('goods',$goodinfo);
			$this->display();
		}
	}	
?>