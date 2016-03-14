<?php
$install = array(
	//'配置项'=>'配置值'
	'MODULE_ALLOW_LIST' => array('Home','Install','Admin'),
    'DEFAULT_MODULE' => 'Home',
       // error，success跳转页面

        // 开启布局
    'LAYOUT_ON' => true,
    'LAYOUT_NAME' => 'Common/layout'   ,
);
$install = include('InstallInfo.php');
return array_merge($install,$InstallInfoConfig);