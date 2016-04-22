<?php
namespace  install\Controller ;
class InstalledController extends  CommonController{
	
	//数据库连接句柄
	private $conn = null;
	//表建立次数
	private $CreateTableValue ;
	//表前缀
	private $tablePrefix = "";
	
	//默认控制器
	public function Index(){
		
		$data = json_encode($_POST);
		$this->assign('data',$data);
		$this->display();
		
	}
	//创建数据表
	public function CreateTable(){
		
		$db = $_POST['db'];
		$db = array_filter($db, 'trim');
		//提取表前缀
        $db['prefix'] = $db['prefix'] == '' ? C('DEFAULT_TABLE_PREFIX')
                                            : $db['prefix'];
		
       //添加'_'作为分割
        if (false === strpos($db['prefix'], '_')) {
            $_POST['db']['prefix'] = $db['prefix'] .= '_';
        }
        //表前缀
        $this->tablePrefix = $db['prefix'];

        // 当前已执行到的sql文件位置
        $this->CreateTableValue = intval($_GET['CreateTableValue']);
        
        if ($this->isComplete()) {
            // 安装完成
            exit();
        }
        // 连接数据库
        $this->conn = $this->connectDb($db);
        // Mysql版本不符合
        $this->invalidMysqlVersion();
        // 选择数据库
        $this->selectDb($db['dbname']);
        // 得到sql文件中的sql语句
        $sql = file_get_contents(C('SYSTEM_SQL_PATH'));
        
        $queries = sql_split($sql, $db['prefix']);
 
        $this->execSql($queries);

        if ($this->isComplete()) {
            // 安装完成
            exit();
        }

        // 插入 admin 数据
        $admin = $_POST['admin'];
        $admin = array_filter($admin, 'trim');
        $this->insertRootAdmin($admin, $db['dbname']);
        $this->closeDb();

        // 配置写入到文件中
        $this->saveConfig($_POST);

        // 安装完成
       $this->ajaxReturn(array('CreateTableValue' => 999999,
                              'info' => '安装完成'));	
	}
	
    /**
     * 连接数据库
     * @param  array  $dbConfig
     * @return handler
     */
    private function connectDb(array $dbConfig) {
        $conn = mysql_connect($dbConfig['host'] . ':' . $dbConfig['port'],
                              $dbConfig['username'],
                              $dbConfig['password']);
        if (!$conn) {
            // 数据库连接失败
            $this->ajaxReturn(array('CreateTableValue' => 0,
                                    'info' => '数据库连接失败！'));
        }
        return $conn;
    }
    /* 检测mysql版本是否过低
     * @return
     */
    private function invalidMysqlVersion() {
        $mysqlVersion = mysql_get_server_info($this->conn);
        if ($mysqlVersion < 4.1) {
            $this->closeDb();
            $this->ajaxReturn(array('CreateTableValue' => 0,
                                    'info' => '数据库版本过低！'));
        }
    }

/**选择数据库@param  string $dbName* @return*/
private function selectDb($dbName) {
        // 设置数据库字符集
        mysql_query('SET NAMES "utf8"');
        // 打开指定的数据库
        if (!mysql_select_db($dbName, $this->conn)) {
            // 指定数据库不存在，创建数据库
            if (!create_database($dbName, $this->conn)) {
                $this->closeDb();
                // 没有权限创建数据库
                $this->ajaxReturn(array('CreateTableValue' => 0,
                                        'info' => '没有权限创建数据库！'));
            }

            if ($this->CreateTableValue == 0) {
                $this->closeDb();

                // 创建数据库成功
                $data = array('CreateTableValue' => 1,
                              'info' => "成功创建数据库:{$dbName}<br>");
                $this->ajaxReturn($data);
            }
        }
    }
  /* 执行sql
   * @param  array $queries
   * @return
   */
    private function execSql($queries) {
        $count = count($queries);

        for ($i = $this->CreateTableValue; $i < $count; $i++) {
            $sql = trim($queries[$i]);

            if (strstr($sql, 'CREATE TABLE')) {
                // CREATE TABLE
                preg_match('/CREATE TABLE `([^ ]*)`/', $sql, $matches);

                if (mysql_query($sql)) {
                    $info = '<li>'. current_state_support("创建数据表{$matches[1]}完成") . '</li>';
                } else {
                    $info = '<li>'. current_state_support("创建数据表{$matches[1]}失败") . '</li>';
                }

                $this->closeDb();
                $this->ajaxReturn(array('CreateTableValue' => ++$i,
                                        'info' => $info));
            } else {
                // DROP TABLE 或 INSERT INTO
                mysql_query($sql);
            }
        }

        $this->CreateTableValue = $i;
    }

    /**
     * admin表中插入root
     * @param array $admin
     * @return
     */
    private function insertRootAdmin($admin, $dbName) {
        mysql_select_db($dbName, $this->conn);

        $admin['password'] = $this->encrypt($admin['password']);

        $sql = "INSERT INTO `{$this->tablePrefix}manage_user` (`manage_id`, `manage_role`, `manage_email`, `manage_passwd`, `manage_name`, `manage_update_date`, `manage_create_date`) VALUES(1, 0, '{$admin['email']}', '{$admin['password']}', 'admin', UNIX_TIMESTAMP(), UNIX_TIMESTAMP());";
		      
        mysql_query($sql);
    }
    /**
     * 写入配置
     * @param  array  $dbConfig
     * @return fixed
     */
    private function saveConfig(array $systemConfig) {
        // 数据库配置
        $config['DB_TYPE'] = 'mysql';
        $config['DB_HOST'] = $systemConfig['db']['host'];
        $config['DB_NAME'] = $systemConfig['db']['dbname'];
        $config['DB_USER'] = $systemConfig['db']['username'];
        $config['DB_PWD'] = $systemConfig['db']['password'];
        $config['DB_PORT'] = $systemConfig['db']['port'];
        $config['DB_PREFIX'] = $systemConfig['db']['prefix'];

        // 站点配置
        $config['SITE_TITLE'] = $systemConfig['site']['title'];
        $config['SITE_KEYWORD'] = $systemConfig['site']['keyword'];
        $config['SITE_DESCRIPTION'] = $systemConfig['site']['description'];

        $data = "<?php return " . var_export($config, true) . ";\r\n";
        if (false === file_put_contents(C('SYSTEM_CONFIG_PATH'), $data)) {
            return false;
        }
		if (false === file_put_contents(C('SYSTEM_CONFIG_PATH_HOME'), $data)) {
            return false;
        }

        chmod(C('SYSTEM_CONFIG_PATH'), 0777);
        return true;
    }

    /**
     * 安装是否完成
     * @return boolean
     */
    private function isComplete() {
        if ($this->CreateTableValue == 999999) {
            return true;
        }

        return false;
    }

    /**
     * 关闭数据库连接
     * @return
     */
    private function closeDb() {
        if ($this->conn) {
            mysql_close($this->conn);
        }
    }

    /**
     * 加密数据
     * @param  string $data 需要加密的数据
     * @return string
     */
    private function encrypt($data) {
        return md5(md5($data));
    }
    
   /**安装完成* @return*/
    public function complete() {
        $this->display();
    }
	
}
