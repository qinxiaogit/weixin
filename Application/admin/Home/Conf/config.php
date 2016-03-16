<?php
$config =  array(
	//'配置项'=>'配置值'
	    // 默认模块
    'MODULE_ALLOW_LIST' => array('Admin'),
	'TMPL_ACTION_ERROR' => 'Common:jump',
    'TMPL_ACTION_SUCCESS' => 'Common:jump',
    // 开启布局
        // 开启布局
    'LAYOUT_ON' => true,
    'LAYOUT_NAME' => 'Common/layout',
    'COMPARE_NAME'=>'成都中亚通茂科技有限公司',
);

$install = include('InstallInfo.php');

return array_merge($install,$config);
