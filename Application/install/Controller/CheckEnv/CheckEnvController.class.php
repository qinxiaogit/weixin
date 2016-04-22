<?php
namespace install\Controller;

class CheckEnvController extends CommonController 
{
	public function Index(){
	//获取系统相关信息
		$this->SystemInfo();
				
		$this->display();
	}
	//获取系统相关的信息
	protected function SystemInfo(){
		
		// 得到当前系统的信息
        $systemInfo = $this->getSystemInfo();
        $this->assign('systeminfo',$systemInfo);

        // 得到PHP版本
        $phpVersion = $this->getPHPVersion();
		$this->assign('phpVersion',$phpVersion);

        // 得到服务器软件
        $serverInfo = $this->getServerInfo();
		$this->assign('serverInfo',$serverInfo);

        // Mysql信息
        $mysqlInfo = $this->getMysqlInfo();
		$this->assign('mysqlInfo',$mysqlInfo);
		
        // 文件上传支持
        $uploadInfo = $this->getUploadInfo();
		$this->assign('uploadInfo',$uploadInfo);
		
        // session支持
        $sessionInfo = $this->getSessionInfo();
		$this->assign('sessionInfo',$sessionInfo);
        
        // GD库支持
        $gdInfo = $this->getGDInfo();
		$this->assign('gdInfo',$gdInfo);
		
		//文件权限信息
		$directories = C('WRITABLE_DIRECTORIES');
		$directoriesState = $this->getDirctoriesState($directories);
	
		$this->assign('directories_state', $directoriesState);
		
	}
	//获取系统信息
	private function getSystemInfo(){
		return  get_system();
	}
	//获取PHP版本信息
	private function  getPHPVersion(){
		return phpversion();
	}
	//获取服务器信息
	private function getServerInfo(){
		return $_SERVER['SERVER_SOFTWARE'];
	}
	//获取mysql数据库支持
	private function getMysqlInfo(){
		return mysql_get_server_info();
	}
	//获取文件上传支持状态
	private function getUploadInfo(){
		if (ini_get('file_uploads')) {
            return current_state_support(ini_get('upload_max_filesize'));
		}
		 return current_state_unsupport('禁止上传');
	}
	//获取session支持信息
	private function getSessionInfo(){
		if (function_exists('session_start')) {
            return current_state_support('支持');
        }
        return current_state_support('不支持');
	}
	//获取GD库支持信息
	private function getGDInfo(){
	if (function_exists('gd_info')) {
            $gd = gd_info();
            return current_state_support($gd['GD Version']);
        }
        return current_state_unsupport('不支持');
    }
	//获取目录状态
	 private function getDirctoriesState(array $directories) {
    	$dirStates = array();

        foreach ($directories as $key => $dir) {
        	$fullDirPath = WEB_ROOT.$dir;
            create_dir($fullDirPath);

            $dirStates[$key]['dir_name'] = $dir;
            // 测试可写
            if (is_writable($fullDirPath)) {
                $dirStates[$key]['writable'] = current_state_support('可写'); 
            } else {
                $dirStates[$key]['writable'] = current_state_unsupport('不可写');
            }

            // 测试可读
            if (is_readable($fullDirPath)) {
                $dirStates[$key]['readable'] = current_state_support('可读'); 
            } else {
                $dirStates[$key]['readable'] = current_state_unsupport('不可读');
            }
			
        }
		  foreach ($directories as $key => $dir) {
			$fullDirPath = WEB_ROOT . $dir;
			delete_dir($fullDirPath);
		}
	
        return $dirStates;
    }
	
}