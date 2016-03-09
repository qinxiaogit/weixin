<?php
return array(
	//'配置项'=>'配置值'
	'MODULE_ALLOW_LIST' => array('Home','Install','Admin'),
    'DEFAULT_MODULE' => 'Home',
       // error，success跳转页面
    'TMPL_ACTION_ERROR' => 'Common:jump',
    'TMPL_ACTION_SUCCESS' => 'Common:jump'
);