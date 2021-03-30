<?php
	defined('YII_ENV') or define('YII_ENV', 'production');
	defined('MAINTENANCE') or define('MAINTENANCE', false);
	if(YII_ENV=='dev'){
		
		defined('APP_URL') or define('APP_URL_LOCAL_IP', 'http://localhost/ULB');
		
	}
	if(YII_ENV=='production'){
		
		defined('APP_URL') or define('APP_URL',  'http://localhost/ULB');
		
	}
	else{
		
		defined('APP_URL') or define('APP_URL',  'http://localhost/ULB');
		
	}

?>