<?php
$config =  array(
	//'配置项'=>'配置值'
	    // 默认模块
    'MODULE_ALLOW_LIST' => array('Install'),
    'DEFAULT_MODULE' => 'Home',

    // 开启布局
    'LAYOUT_ON' => true,
    'LAYOUT_NAME' => 'Common/layout'  
);

$install = include('InstallInfo.php');

return array_merge($install,$config);
