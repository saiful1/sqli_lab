<!DOCTYPE html>
<html>
<head>
	<title>SQL Injection Section 15</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<center>
		<h1>Welcome! 1337</h1><hr>
		<h3>Hint: Post SQL Injection - Error Based</h3><br>
			<div align="center" style="margin:0 auto; background-color:#E8E8E8; border:1px solid #666; text-align:center; width:350px; height:130px; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;">
				<div style="padding-top:10px; font-size:15px;">
					<form action="" method="post">
						<div style="margin-top:15px; height:30px;">Username : &nbsp;&nbsp;&nbsp;
							<input type="text"  name="user" value=""/>
						</div>  
						<div> Password  : &nbsp;&nbsp;&nbsp;&nbsp;
							<input type="text" name="pass" value=""/>
						</div>
						<div style=" margin-top:9px;margin-left:90px;">
							<input type="submit" name="submit" value="Submit" />
						</div>
					</form>
				</div>
			</div>
			<?php
				set_time_limit(0);
				error_reporting(0);
				require_once '../database/config.php';

				if(isset($_POST['submit'])) {
					$user = $_POST['user'];
					$pass = $_POST['pass'];
					$user = '"'.$user.'"';
					$pass = '"'.$pass.'"';

					$sql 	= "SELECT username, password, email FROM users WHERE username = ($user) AND password = ($pass) LIMIT 0,1";
					$result = mysql_query($sql);

					if(mysql_num_rows($result) > 0) {
						$row 	= mysql_fetch_array($result);
					  	echo '<br>Your E-Mail : ', $row['email'], '<br><br> <img src="../images/ok.png" >';
				  	} else {
					  	echo print_r(mysql_error(), true), '<br> <img src="../images/error.png">';
					}
				}
			?>
		<p>For More Info Visit <a href="http://ubhteam.org" target="_blank">UBH Team</a></p>
	</center>
</body>
</html>
