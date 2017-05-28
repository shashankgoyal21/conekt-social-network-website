<?php
include('home.php');
include('config.php');
?>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
        <title>New Message</title>
    </head>
    <body>
    
<?php

if(isset($_SESSION['email']))
{
$form = true;
$otitle = '';
$orecip = '';
$omessage = '';
if(isset($_POST['title'], $_POST['recip'], $_POST['message']))
{
	$otitle = $_POST['title'];
	$orecip = $_POST['recip'];
	$omessage = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$otitle = stripslashes($otitle);
		$orecip = stripslashes($orecip);
		$omessage = stripslashes($omessage);
	}
	if($_POST['title']!='' and $_POST['recip']!='' and $_POST['message']!='')
	{
		$title = $mysqli->real_escape_string($otitle);
		$recip = $mysqli->real_escape_string($orecip);
		$message = $mysqli->real_escape_string(nl2br(htmlentities($omessage, ENT_QUOTES, 'UTF-8')));
		$dn1 = $mysqli->query('select count(user_id) as recip, user_id as recipid, (select count(*) from pm) as npm from users where user_id="'.$recip.'"');
		$myID = $mysqli->query('SELECT user_id from users WHERE email="'.$email.'"');
		$myID = $myID->fetch_assoc();
		$dn1 = $dn1->fetch_assoc();
		if($dn1['recip']==1)
		{
			if($dn1['recipid']!=$_SESSION['email'])
			{
				$id = $dn1['npm']+1;
				if($mysqli->query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$title.'", "'.$myID['user_id'].'", "'.$dn1['recipid'].'", "'.$message.'", "'.time().'", "yes", "no")'))
				{
	?>
	<div class="message">The PM have successfully been sent.<br />
	<a href="listpm.php">List of your Personal Messages</a></div>
	<?php
					$form = false;
				}
				else
				{
					$error = 'An error occurred while sending the PM.';
				}
			}
			else
			{
				$error = 'You cannot send a PM to yourself.';
			}
		}
		else
		{
			$error = 'The recipient of your PM doesn\'t exist.';
		}
	}
	else
	{
		$error = 'A field is not filled.';
	}
}
elseif(isset($_GET['recip']))
{
	$orecip = $_GET['recip'];
}
if($form)
{
if(isset($error))
{
	echo '<div class="message">'.$error.'</div>';
}
?></br></br></br></br></br></br></br></br></br></br></br>
<div class="content">
<?php
$nb_new_pm = $mysqli->query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['email'].'" and user1read="no") or (user2="'.$_SESSION['email'].'" and user2read="no")) and id2="1"');
$nb_new_pm = $nb_new_pm->fetch_assoc();
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">
	<div class="box_left">
     &gt; <a href="listpm.php">List of you PMs</a> &gt; New PM
    </div>
	<div class="box_right">
     	<a href="listpm.php">Your messages(<?php echo $nb_new_pm; ?>)</a> - <a href="home.php?id=<?php echo $_SESSION['email']; ?>"><?php echo htmlentities($_SESSION['email'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="logout.php">Logout</a>)
    </div>
    <div class="clean"></div>
</div>
	<h1>New Personal Message</h1>
    <form action="newpm.php" method="post">
		Please fill this form to send a PM:<br />
        <label for="title">Title</label><input type="text" value="<?php echo htmlentities($otitle, ENT_QUOTES, 'UTF-8'); ?>" id="title" name="title" /><br />
        <label for="recip">Recipient<span class="small">(User ID)</span></label><input type="text" value="<?php echo htmlentities($orecip, ENT_QUOTES, 'UTF-8'); ?>" id="recip" name="recip" /><br />
        <label for="message">Message</label><textarea cols="40" rows="5" id="message" name="message"><?php echo htmlentities($omessage, ENT_QUOTES, 'UTF-8'); ?></textarea><br />
        <input type="submit" value="Send" />
    </form>
</div>
<?php
}
}
else
{
?>
<div class="message">You must be logged to access this page.</div>
<div class="box_login">
	<form action="login.php" method="post">
		<label for="username">Username</label><input type="text" name="username" id="username" /><br />
		<label for="password">Password</label><input type="password" name="password" id="password" /><br />
        <label for="memorize">Remember</label><input type="checkbox" name="memorize" id="memorize" value="yes" />
        <div class="center">
	        <input type="submit" value="Login" /> <input type="button" onclick="javascript:document.location='signup.php';" value="Sign Up" />
        </div>
    </form>
</div>
<?php
}
?>
	</body>
</html>