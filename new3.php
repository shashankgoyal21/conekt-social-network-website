<?php
include('config.php');
include('home.php');
if(isset($_GET['emailss'])){
	echo "dsfasdf";
}
if(isset($_POST['save']))
{
	if(get_magic_quotes_gpc())
	{
		$_POST['EMail'] = stripslashes($_POST['EMail']);
	}
	$newEmail=$_POST['EMail'];
	if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$newEmail))
	{
		$newEmail = $mysqli->real_escape_string($newEmail);
		$dn = $mysqli->query('select user_id from users where email="'.$newEmail.'"');
		if($dn->num_rows==0)
		{
			$id = $mysqli->query('SELECT user_id from users WHERE email="'.$email.'"');
			$id = $id->fetch_array(MYSQLI_NUM);
			if($mysqli->query('UPDATE users SET email="'.$newEmail.'" WHERE user_id="'.$id[0].'"'))
			{?><div class="message">
				<?php echo "Email updated Successfully"; ?></div><?php
				$login = "login.php";
				?><div class="message"> <a href="<?php echo $login; ?>">Logout from all browsers</a></div>
				<?php
			}
			else
				echo "Something Went Wrong...Try Again LATER!!!";
		}
		else
			echo "The email is already used  for connecting with people!!! Choose Another...";
	}
	else
		echo " Invalid Email";
}
?>

<html>
<head>
<link href="style.css" rel="stylesheet" title="Style">
</head>
</br>
<div class="center">
<form method="post">
Email: &emsp;&emsp;&emsp;&emsp; 
<input type="text" name="EMail"  placeholder="EMail" value="">
&emsp;&emsp;&emsp;	<input type="submit" name="save" value="Save Changes">
</div>
</form>