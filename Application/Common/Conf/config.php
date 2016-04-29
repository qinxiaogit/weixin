<?php
	$installInfo = include('InstallInfo.php');
	$config = array('APPID'=>"wxcdf173c015ea4525",
					'TOKEN'=>"ZYTM",
					"CRYPT"=>"XCaucpO70vGMxfSXIiKdMadhCmGwrwt2aIwUwnFD8Tb",
					"SECRET"=>"4652a7ab74eeb0c2bda8d29448ef44e4"
		);
	return  array_merge($config,$installInfo);
