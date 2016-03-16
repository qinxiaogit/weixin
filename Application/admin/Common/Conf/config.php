<?php
$install = array(
       // error，success跳转页面

        // 开启布局
    'LAYOUT_ON' => true,
    'LAYOUT_NAME' => 'Common/layout'   ,
);
$install = include('InstallInfo.php');
return array_merge($install,$InstallInfoConfig);