<?php
include('config.php');
$check = $mysqli->query('SELECT * from users');
?>
<html>
<head>
<style>
#pop{
display:none;
height:280px;
width:470px;
position:fixed;
bottom:50%;
right:50%;
border:2px solid;
padding:10px;
background:#FFFFFF;
border-radius:9px;
 left:0;
    right:0;
 top:0; 
 bottom:0; 
 margin:auto;
}
#close{
	right:5;
	top:5;
	float:right;
}

</style>
<link href="style.css" rel="stylesheet" title="Style" />
<title>Connekt</title>
</head>
<body background="images/ConnectingPeople.jpg">
<div id="pop">
<button id="close" onclick="document.getElementById('pop').style.display='none' ">X</button><br>
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
<a href="displayPost.php" style="color:lightblue;">Start your Conektion</a></div>
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
</br>
</br></br></br>
</br></br></br>
</br></br>
	<div class="message">
	<?php
	echo $message;?>
	</div>
<?php
}
?>
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
</div>
<div class = 'header1'>
	<div class="box_left" style="color:lightblue">
    	<button id="signup">Sign Up</button>
    </div>
	<a style="color:BLUE;align:center;"><center>Conekting to the new World</center</a>
	<div class="box_right" style="color:lightblue">
    	<button style="margin-right:20" onclick="document.getElementById('pop').style.display='block' ">Login</button>
    </div>
    <div class="clean"></div>

    </div>  
	<button onclick="document.getElementById('pop').style.display='block' ">Login</button>
	<div style="color:lightblue">
<?php
if(isset($_POST['submit'])/*isset($_POST['first_name'], $_POST['last_name'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['mobile'], $_POST['dob']) and $_POST['email']!='' and $_POST['password']!=''*/)
{
	if($_POST['first_name']!='' and $_POST['last_name']!='' and $_POST['email']!='' and $_POST['password']!='' and $_POST['passverif']!='' and $_POST['mobile']!='' and $_POST['dob']!='' and $_POST['city']!='' and $_POST['state']!=''){
	if(get_magic_quotes_gpc())
	{
		$_POST['first_name'] = stripslashes($_POST['first_name']);
		$_POST['last_name'] = stripslashes($_POST['last_name']);
		$_POST['password'] = stripslashes($_POST['password']);
		$_POST['passverif'] = stripslashes($_POST['passverif']);
		$_POST['email'] = stripslashes($_POST['email']);
		$_POST['mobile'] = stripslashes($_POST['mobile']);
		$_POST['dob'] = stripslashes($_POST['dob']);
		$_POST['city'] = stripslashes($_POST['city']);
		$_POST['state'] = stripslashes($_POST['state']);
	}
	$first_name=$_POST['first_name'];
		$last_name=$_POST['last_name'];
		$password=$_POST['password'];
		$passverif=$_POST['passverif'];
		$email=$_POST['email'];
		$mobile=$_POST['mobile'];
		$dob=$_POST['dob'];
		$city=$_POST['city'];
		$state=$_POST['state'];
		$gender = $_POST['gender'];
	if($_POST['password']==$_POST['passverif'])
	{
		if(strlen($_POST['password'])>=8)
		{
			if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
			{
				$first_name = $mysqli->real_escape_string($first_name);
				$last_name = $mysqli->real_escape_string($last_name);
$password = $mysqli->real_escape_string(sha1($password));
$email = $mysqli->real_escape_string($email);
$mobile = $mysqli->real_escape_string($mobile);
$dob = $mysqli->real_escape_string($dob);
$city = $mysqli->real_escape_string($city);
$city = $mysqli->real_escape_string($city);
$state = $mysqli->real_escape_string($state);
				$lid = $mysqli->query('select lid from location where city = "'.$city.'" and state = "'.$state.'"')->fetch_array(MYSQLI_NUM);
				$dn = $mysqli->query('select user_id from users where email="'.$email.'"')->num_rows;
				if($dn==0)
				{
					$dn2 = $mysqli->query('select user_id from users')->num_rows;
					$id = $dn2+1;
					if($mysqli->query('insert into users(user_id, fname, lname, pass, email,gender, mobile_no,dob,lid) values ("'.$id.'", "'.$first_name.'","'.$last_name.'", "'.$password.'", "'.$email.'","'.$gender.'" ,"'.$mobile.'", "'.$dob.'", "'.$lid[0].'")'))
					{
						$form = false;
?><br><br><br><br>
<div class="message">You have successfully been signed up. You can now log in.<br />
<a href="login.php">Log in</a></div>
<?php
					}
					else
					{
						$form = true;
						$message = 'An error occurred while signing you up.';
						die(mysql_error());
					}
				}
				else
				{
					$form = true;
					$message = 'Another user already use this username.';
				}
			}
			else
			{
				$form = true;
				$message = 'The email you typed is not valid.';
			}
		}
		else
		{
			$form = true;
			$message = 'Your password must have a minimum of 8 characters.';
		}
	}
	else
	{
		$form = true;
		$message = 'The passwords you entered are not identical.';
	}
}
else if($_POST['first_name']=='')
{
	$form=true;
	$message="Fill the first name";
}
else if($_POST['last_name']=='')
{
	$form=true;
	$message="Fill the last name";
}
while($chk1 = $check->fetch_assoc()){
if($_POST['email']==''){
	$form=true;
	$message="Enter EMail";
}
else if($_POST['email'] == $chk1['email'])
{
	$form=true;
	$message="Email already exists";
}
}
if($_POST['password']=='')
{
	$form=true;
	$message="Enter Password";
}
else if($_POST['passverif']==''){
	$form=true;
	$message="Password missmatch";
}
else if($_POST['passverif']!=$_POST['passverif']){
	$form=true;
	$message="Password missmatch";
}
else if($_POST['mobile']=='' or preg_match('/d[0-9]{10}$/', $_POST['mobile'])){
	$form=true;
	$message="Enter a valid mobile number";
}
else if($_POST['dob']==''){
	$form=true;
	$message="Enter your Date of Birth";
}
else if($_POST['city']==''){
	$form=true;
	$message="Enter city";
}
else if($_POST['state']==''){
	$form=true;
	$message="Enter State";
}
else if($_POST['gender']==''){
	$form=true;
	$message="Choose your Gender";
}
}
else
{
	$form = true;
}
if($form)
{
	if(isset($message))
	{?><br><br><br><br><br><?php
		echo '<div class="message">'.$message.'</div>';
	}
?>	<br><br><br>
    <form action="index.php" method="post" name="myform" >
        <h1>Please fill this form to sign up:</h1><br />
			

		<div class="content">
		<div class="center">		
		
            <label for="fname">*First name</label><input type="text" name="first_name" value="<?php if(isset($_POST['first_name'])){echo htmlentities($_POST['first_name'], ENT_QUOTES, 'UTF-8');} ?>" /><br /></br>
			<label for="lname">*Last name</label><input type="text" name="last_name" value="<?php if(isset($_POST['last_name'])){echo htmlentities($_POST['last_name'], ENT_QUOTES, 'UTF-8');} ?>" /><br /></br>
            <label for="email">*Email</label><input type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" /><br /></br>
            <label for="password">*Password<span class="small">(8 characters min.)</span></label><input type="password" name="password" /><br /></br>
            <label for="passverif">*Password<span class="small">(verification)</span></label><input type="password" name="passverif" /><br /></br>
            <label for="mobile">*Mobile Number<span class="small"></span></label><input type="text" name="mobile" value="<?php if(isset($_POST['mobile'])){echo htmlentities($_POST['mobile'], ENT_QUOTES, 'UTF-8');} ?>" /><br /></br>
			<label for="dob">*Date Of Birth(1999/12/30)<span class="small"></span></label><input type="text" name="dob" pattern="\d{4}/\d{1,2}/\d{1,2}" value="<?php if(isset($_POST['dob'])){echo htmlentities($_POST['dob'], ENT_QUOTES, 'UTF-8');} ?>" /><br /></br>
			<label for="city">*City<span class="small"></span></label><input type="text" name="city" value="<?php if(isset($_POST['city'])){echo htmlentities($_POST['city'], ENT_QUOTES, 'UTF-8');} ?>" /><br /></br>
			<label for="state">*State<span class="small"></span></label><input type="text" name="state" value="<?php if(isset($_POST['state'])){echo htmlentities($_POST['state'], ENT_QUOTES, 'UTF-8');} ?>" /><br /></br>
			<label for="male"><span class="small"></span></label>Male<input type="radio" value="m" name="gender">
			<label for="female"><span class="small"></span></label>Female<input type="radio" value="f" name="gender"><br><br>
            <input type="submit" name="submit" id="submit1" value="sign up" />
		</div></div>
    </form>
<?php
}
?>
</body>

</html>