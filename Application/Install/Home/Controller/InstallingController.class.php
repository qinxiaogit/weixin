<?php 

namespace  Home\Controller ;

class InstallingController extends CommonController{
	public function index(){
		$this->display();
	}
	//检测数据库状态 ->通过ajax请求执行
	public function checkDbConnect(){
		  if (!isset($_POST['db']['password'])) {
            return $this->ajaxReturn(false);
        }
		 
        $host = $_POST['db']['host'] . ':' . $_POST['db']['port'];
        $conn = mysql_connect($host,
                              $_POST['db']['username'],
                              $_POST['db']['password']);

        if (!$conn) {
            $this->ajaxReturn(false);
        }

        mysql_close($conn);
        $this->ajaxReturn(true);
	}
	
	
}
