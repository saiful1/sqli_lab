<?php
$config = array(
	'host' 		=> 	'localhost',	//Enter Your Host Name
	'username' 	=> 	'root',			//Enter Your Host Username
	'password'	=> 	'',				//Enter Your Host password
	'dbname'	=>	'sqli_lab'		//No need to change this
);

mysql_connect($config['host'], $config['username'], $config['password']);
mysql_select_db($config['dbname']);