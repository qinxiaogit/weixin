<?php

return array(

'URL_HTML_SUFFIX'=>'.shtml',
    // 调试页
   // E:\wamp\www\Application\Install\Home\Conf
    // 'SHOW_PAGE_TRACE' =>true,
        'URL_HTML_SUFFIX'=>'.shtml',
    'SYSTEM_VERSION'=>'1.0.12',
    'AUTHOR_NAME'=>'覃枭',
    'SYSTEM_NAME'=>'中亚通茂科技有限公司',
    
    //WEB_ROOT . 'Install/Data/database.sql',
	'SYSTEM_SQL_PATH'=>WEB_ROOT.'Application/Install/Home/Conf/data.sql',
    // 默认模块
    'MODULE_ALLOW_LIST' => array('Install'),
    'DEFAULT_MODULE' => 'Install',

    // 开启布局
    'LAYOUT_ON' => true,
    'LAYOUT_NAME' => 'Common/layout'    
);