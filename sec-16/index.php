<!DOCTYPE html>
<html>
<head>
	<title>SQL Injection Section 16</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<center>
		<h1>Welcome! 1337</h1><hr>
		<h3>Hint: Update Query Injection [Reset Password]</h3><br>
			<div align="center" style="margin:0 auto; background-color:#E8E8E8; border:1px solid #666; text-align:center; width:350px; height:130px; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;">
				<div style="padding-top:10px; font-size:15px;">
					<form action="" method="post">
						<div style="margin-top:15px; height:30px;">Username : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="text"  name="user" value=""/>
						</div>  
						<div>New Password  : &nbsp;&nbsp;
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

					$sql="SELECT username, password FROM users WHERE username= '$user' LIMIT 0,1";

					$result=mysql_query($sql);
					$row = mysql_fetch_array($result);
					
					if($row)
					{
						$row1 = $row['username'];  	
						$update="UPDATE users SET password = '$pass' WHERE username='$row1'";
						mysql_query($update);
				  		echo "<br>";
					
						if (mysql_error()) {
							echo '<font color= "#900" font size = 3 >';
							print_r(mysql_error());
							echo "</br></br>";
							echo "</font>";
						} else {
							echo '<font color= "#900" font size = 3 >';
							echo "<br>";
							echo "</font>";
						}
						echo '<img src="../images/ok.png"></font>';
				  		} else {
							echo '<font size="4.5" color="#900"></br>';
							echo '<img src="../images/error.png"></font>';
						}
				}
			?>
		<p>For More Info Visit <a href="http://ubhteam.org" target="_blank">UBH Team</a></p>
	</center>
</body>
</html>
