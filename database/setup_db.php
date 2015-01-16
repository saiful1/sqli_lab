<?php
set_time_limit(0);
error_reporting(0);
require_once 'database/config.php';

if(isset($_POST['submit'])) {

	//Connecting to the Database
	$conn = mysql_connect($config['host'], $config['username'], $config['password']);

	if($conn) {
		echo "[+]..................Connecting to the Database <br>";
	} else {
		echo "[-]..................Error While Connecting to the Database - ", mysql_error(), "<br>";
	}

	//Deleting Database if Exists
	$sql="DROP DATABASE IF EXISTS `sqli_lab`;";

	if (mysql_query($sql)) {
		echo "[+]..................Deleting Database if Exists <br>";
	}
	else {
		echo "[-]..................Error While Deleting Database - ", mysql_error(), "<br>";
	}

	//Creating new database security
	$sql="CREATE database `sqli_lab` CHARACTER SET `gbk`;";

	if (mysql_query($sql)){
		echo "[+]..................Creating Database <b><i> sqli_lab </i></b><br>";
	} else {
		echo "[-]..................Error While Creating Database - ", mysql_error(), "</br>";
	}

	//Selecting Database
	$select_db 	= mysql_select_db($config['dbname']);
	
	if($select_db) {
		echo "[+]..................Selecting Database <br>";
	} else {
		echo "[-]..................Error While Selecting Database - ", mysql_error(), "<br>";
	}

	//creating table users
	$sql="
		CREATE TABLE IF NOT EXISTS `users` (
		`id` int(11) NOT NULL,
		  `first_name` varchar(30) NOT NULL,
		  `last_name` varchar(30) NOT NULL,
		  `username` varchar(30) NOT NULL,
		  `password` varchar(100) NOT NULL,
		  `email` varchar(50) NOT NULL
		) ENGINE=InnoDB  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;
	";
	if (mysql_query($sql)) {
		echo "[+]..................Creating Table <b><i> users </i></b><br>";
	} else {
		echo "[-]..................Error While Creating Table <b><i> users </i></b> - ", mysql_error(), "<br>";
	}

	//creating table session
	$sql="
		CREATE TABLE IF NOT EXISTS `session` (
		`id` int(11) NOT NULL,
		  `session_name` varchar(30) NOT NULL,
		  `hash` varchar(50) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
	";
	if (mysql_query($sql)) {
		echo "[+]..................Creating Table <b><i> session </i></b><br>";
	} else {
		echo "[-]..................Error While Creating Table <b><i> session </i></b> - ", mysql_error(), "<br>";
	}

	//creating table cookie
	$sql="
		CREATE TABLE IF NOT EXISTS `cookie` (
		`id` int(11) NOT NULL,
		  `cookie_name` varchar(30) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			";
	if (mysql_query($sql)) {
		echo "[+]..................Creating Table <b><i> cookie </i></b><br>";
	} else {
		echo "[-]..................Error While Creating Table <b> cookie </i></b> - ", mysql_error(), "<br>";
	}

	//inserting data into users
	$sql="
		INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `email`) VALUES
		(1, 'Admin', 'Admin', 'admin', 'admin123', 'admin@admin.com'),
		(2, 'Ananta', 'Jalil', 'ananta', 'ananta123', 'ananta@ananta.com'),
		(3, 'Shakib', 'Khan', 'shakib', 'shakib123', 'shakib@shakib.com');
	";
	if (mysql_query($sql)) {
		echo "[+]..................Inserting Data into <b><i> users </i></b> table <br>";
	} else {
		echo "[-]..................Error While Inserting Data into <b><i> users </i></b> table - ", mysql_error(), "<br>";
	}

	//indexes for table users
	$sql="
		ALTER TABLE `users`
	 	 ADD PRIMARY KEY (`id`);
	 ";

	if (mysql_query($sql)) {
		echo "[+]..................Indexing for <b><i> users </i></b> table <br>";
	} else {
		echo "[-]..................Error While Indexing for <b><i> users </i></b> table - ", mysql_error(), "<br>";
	}

	//AUTO_INCREMENT for table users
	$sql="
		ALTER TABLE `users`
		MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
	 ";

	if (mysql_query($sql)) {
		echo "[+]..................Setting AUTO_INCREMENT for <b><i> users </i></b> table <br>";
	} else {
		echo "[-]..................Error While Setting AUTO_INCREMENT for <b><i> users </i></b> table - ", mysql_error(), "<br>";
	}
}
