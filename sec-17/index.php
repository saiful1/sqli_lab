<!DOCTYPE html>
<html>
<head>
	<title>SQL Injection Section 17</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<center>
		<h1>Welcome! 1337</h1><hr>
		<h3>Hint: Header Injection [Cookie Based]</h3><br>
			<?php
				set_time_limit(0);
				error_reporting(0);
				require_once '../database/config.php';

				if(!isset($_COOKIE['uname'])) {

					echo <<<EOD
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
EOD;

					function check_input($value) {
						if(!empty($value)) {
							$value = substr($value,0,20);
						}
						if (get_magic_quotes_gpc()) {
							$value = stripslashes($value);
						}
						if (!ctype_digit($value)) {
							$value = "'" . mysql_real_escape_string($value) . "'";
						} else {
							$value = intval($value);
						}
						
						return $value;
					}

					if(isset($_POST['user']) && isset($_POST['pass'])) {
				
						$user = check_input($_POST['user']);
						$pass = check_input($_POST['pass']);

						$sql="SELECT  users.username, users.password FROM users WHERE users.username=$user and users.password=$pass ORDER BY users.id DESC LIMIT 0,1";
						$result1 = mysql_query($sql);
						$row1 = mysql_fetch_array($result1);
						$cookee = $row1['username'];

						if($row1) {
							echo '<font color= "#900" font size = 3 >';
							setcookie('uname', $cookee, time()+3600);	
							header ('Location: index.php');
							echo "I LOVE YOU COOKIES </font>";
							echo '<font color= "#0000ff" font size = 3></font>';
							print_r(mysql_error(), true);			
							echo '<img src="../images/ok.jpg">';
						} else {
							echo '<font color= "#0000ff" font size="3">';
							print_r(mysql_error(), true);
							echo '<img src="../images/error.png"></font>';
						}
					}
				echo "</font></font></div>";
			} else {
				if(!isset($_POST['submit'])) {
					$cookee = $_COOKIE['uname'];
					$format = 'D d M Y - H:i:s';
					$timestamp = time() + 3600;
					echo "<center>";					
					echo '<font color= "#900" font size = 5 >';
					echo "<b>Cookie Name</b> : $cookee & Expire Date: " . date($format, $timestamp);
					echo "<br></font>";
					$sql="SELECT * FROM users WHERE username='$cookee' LIMIT 0,1";
					$result=mysql_query($sql);

					if (!$result) {
		  				die('Issue with your mysql: ' . mysql_error());
		  			}
					$row = mysql_fetch_array($result);
					if($row) {
					  	echo '<font color= "red" font size="5">';	
					  	echo 'Username</font>&nbsp;:&nbsp;<font color= "grey" font size="5">'. $row['username'], "<br>";
						echo '<font color= "red" font size="5">';	
						echo 'Password</font>&nbsp;:&nbsp;' .$row['password'];
					  	echo "</b><br>";
						echo '<font color="red">ID:</font>' .$row['id'], "</font></font>";
					}
						echo '<center>';
						echo '<form action="" method="post">';
						echo '<input  type="submit" name="submit" value="Delete Your Cookie!">';
						echo '</form></center>';
					} else {
						echo '<center>';
						echo '<font color= "#900" font size = 6 >';
						echo " Your Cookie is deleted";
						setcookie('uname', $row1['username'], time()-3600);
						header ('Location: index.php');
						echo '</font></center></br>';
					}
					echo "</fonr></font></font>";
				}
			?>
		<p>For More Info Visit <a href="http://ubhteam.org" target="_blank">UBH Team</a></p>
	</center>
</body>
</html>
