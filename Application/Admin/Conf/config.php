<?php

$install = include(WEB_ROOT.'/Application/Common/Conf/InstallInfo.php');
$sysMenu = include('SysConfig.php');
$config =  array(
	//'配置项'=>'配置值'
	    // 默认模块
	    'URL_HTML_SUFFIX'=>'.xhtml',
    'MODULE_ALLOW_LIST' => array('Admin'),
	'TMPL_ACTION_ERROR' => 'Common:jump',
    'TMPL_ACTION_SUCCESS' => 'Common:jump',
        // 菜单项配置
    'MENU' => $sysMenu,
    // 开启布局
        // 开启布局
    'LAYOUT_ON' => true,
    'LAYOUT_NAME' => 'Common/layout',
    'COMPARE_NAME'=>'成都中亚通茂科技有限公司',
);

return array_merge($install,$config);
