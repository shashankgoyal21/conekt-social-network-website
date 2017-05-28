<?php
include('config.php');
ob_clean();
session_start();
?>

<html>
<head>
<link href="style.css" rel="stylesheet" title="Style" />
<title>LogIn</title>
</head>
<body background="images/ConnectingPeople.jpg">
<div class="header1">
<div class="box_left"><a href="login.php" style="color:Blue"><h2>LogIn</h2></a></div>
<div class="box_right">
<a href="signup.php" style="color:blue;"><h2>Sign Up</h2></a>
</div>
</div>
<?php

if(isset($_POST['email'],$_POST['password']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		if(get_magic_quotes_gpc())
		{
			$email = $mysqli->real_escape_string(stripslashes($email));
			$password = $mysqli->real_escape_string(stripslashes($password));
		}
		else
		{
			$email = $mysqli->real_escape_string($email);
			$password = $mysqli->real_escape_string($password);
		}
		$req = $mysqli->query('select pass,user_id from users where email="'.$email.'"');
		$dn = $req->fetch_assoc();
		if($dn['pass']==sha1($password) and ($req->num_rows)>0)
		{
			$email = $_POST['email'];
			$home = "home.php";
			$form = false;
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['user_id'] = $dn['user_id'];
			if(isset($_POST['memorize']) and $_POST['memorize']=='yes')
			{
				$one_year = time()+(60*60*24*365);
				setcookie('email', $email, $one_year);
				setcookie('password', $password, $one_year);
			}
?><br></br></br>
<div class="message">You have successfully been logged.<br />
<a href="home.php" style="color:lightblue;">Start your Conektion</a></div>
<?php
		}
		else
		{
			$form = true;
			$message = 'The email or password you entered are not good.';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
if(isset($message))
{
	?>
	<div class="message">
	<?php
	echo $message;?>
	</div>
<?php
}
?>



</br></br></br></br></br><h1 style="font-family:Monotype Corsiva;font-style:oblique;font-size:40px">Login To Conekt</h1></br></br></br></br></br>
<div class="content">
<form action="login.php" method="post">
<div class="center">
			<label for="email">Email</label><input type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');}
else if(isset($_COOKIE['email'])){echo $_COOKIE['email'];}			?>" /><br /></br>
			
			<label for="password">Password</label><input type="password" name="password" value="<?php if(isset($_POST['password'])){echo htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');} else if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>" /><br /></br>
			
			<label for="memorize">Remember</label><input type="checkbox" name="memorize" id="memorize" value="yes" /><br />
            
			<input type="submit" value="Login" />
</div>
</form>
</div>
<?php
	}
?>
</body>

</html>