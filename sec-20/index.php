<!DOCTYPE html>
<html>
<head>
	<title>SQL Injection Section 20</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<center>
		<h1>Welcome! 1337</h1><hr>
		<h3>Hint: Blacklisted UNION & SELECT</h3><br>
			<?php
				set_time_limit(0);
				error_reporting(0);
				require_once '../database/config.php';

				function blacklist($id) {
					$id= preg_replace('/[\/\*]/',"", $id);		//strip out /*
					$id= preg_replace('/[--]/',"", $id);		//Strip out --.
					$id= preg_replace('/[#]/',"", $id);			//Strip out #.
					$id= preg_replace('/[ +]/',"", $id);	    //Strip out spaces.
					$id= preg_replace('/select/m',"", $id);	    //Strip out spaces.
					$id= preg_replace('/[ +]/',"", $id);	    //Strip out spaces.
					$id= preg_replace('/union/s',"", $id);	    //Strip out union
					$id= preg_replace('/select/s',"", $id);	    //Strip out select
					$id= preg_replace('/UNION/s',"", $id);	    //Strip out UNION
					$id= preg_replace('/SELECT/s',"", $id);	    //Strip out SELECT
					$id= preg_replace('/Union/s',"", $id);	    //Strip out Union
					$id= preg_replace('/Select/s',"", $id);	    //Strip out select
					return $id;
				}

				if(isset($_GET['id'])) {
					$id = $_GET['id'];
					$id= blacklist($id);
					$hint=$id;

					$sql 	= "SELECT * FROM users WHERE id='$id' LIMIT 0,1";
					$result = mysql_query($sql);
					$row 	= mysql_fetch_array($result);

					if($row) {
					  	echo '<font color= "#0000ff">';	
					  	echo 'Username : ' .$row['username'], "<br>";
					  	echo 'Password : ' .$row['password'], "</font>";
				  	} else  {
					  	echo '<font color= "#900">', print_r(mysql_error(), true), "</font>";
					}
					echo "<h4> Your Input : " .$hint, "</h4>";
				} else {
					echo "<h4> Input the ID as parameter with numeric value </h4>";
				}
			?>
		<p>For More Info Visit <a href="http://ubhteam.org" target="_blank">UBH Team</a></p>
	</center>
</body>
</html>