<!DOCTYPE html>
<html>
<head>
	<title>SQL Injection Section 8</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<center>
		<h1>Welcome! 1337</h1><hr>
		<h3>Hint: Double Query SQL Injection</h3><br>
			<?php
				set_time_limit(0);
				error_reporting(0);
				require_once '../database/config.php';

				if(isset($_GET['id'])) {
					$id = $_GET['id'];
					$id = '"' .$id. '"';

					$sql 	= "SELECT * FROM users WHERE id = $id LIMIT 0,1";
					$result = mysql_query($sql);
					$row 	= mysql_fetch_array($result);

					if($row) {
					  	echo '<font color= "#0000ff">';	
					  	echo  "Logged in<br></font>";
				  	} else {
					  	echo '<font color= "#900">', print_r(mysql_error(), true), "</font>";
					}
				} else {
					echo "<h4> Input the ID as parameter with numeric value </h4>";
				}
			?>
		<p>For More Info Visit <a href="http://ubhteam.org" target="_blank">UBH Team</a></p>
	</center>
</body>
</html>