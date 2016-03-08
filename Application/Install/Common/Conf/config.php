<?php

return array(

'URL_HTML_SUFFIX'=>'.shtml',
    // 调试页
   // E:\wamp\www\Application\Install\Home\Conf
    // 'SHOW_PAGE_TRACE' =>true,
    
    //WEB_ROOT . 'Install/Data/database.sql',
	'SYSTEM_SQL_PATH'=>WEB_ROOT.'Application/Install/Home/Conf/data.sql',
    // 默认模块
    'MODULE_ALLOW_LIST' => array('Install'),
    'DEFAULT_MODULE' => 'Home',

    // 开启布局
    'LAYOUT_ON' => true,
    'LAYOUT_NAME' => 'Common/layout'    
);