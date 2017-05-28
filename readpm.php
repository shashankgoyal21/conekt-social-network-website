<?php
include('home.php');
include('config.php');
?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="style.css" rel="stylesheet" title="Style" />
		<script language="JavaScript">
function showInput() {
    var message_entered =  document.getElementById("user_input").value;

    document.getElementById('display').innerHTML = message_entered;
}

  </script>
        <title>Read a PM</title>
    </head>
    <body>
<?php
if(isset($_SESSION['email']))
{
if(isset($_GET['id']))
{
$id = intval($_GET['id']);

$myID = $mysqli->query('SELECT user_id from users WHERE email="'.$email.'"');
		$myID = $myID->fetch_assoc();
$req1 = $mysqli->query('select title, user1, user2 from pm where id="'.$id.'" and id2="1"');
$dn1 = $req1->fetch_assoc();
echo $myID['user_id'];
if($req1->num_rows==1)
{
if($dn1['user1']==$myID['user_id'] or $dn1['user2']==$myID['user_id'])
{
if($dn1['user1']==$myID['user_id'])
{
	$mysqli->query('update pm set user1read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 2;
}
else
{
	$mysqli->query('update pm set user2read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 1;
}
$req2 = $mysqli->query('select pm.user1 as replyTo, pm.timestamp, pm.message, users.user_id as userid, users.fname from pm, users where pm.id="'.$id.'" and (users.user_id=pm.user1 or users.user_id=pm.user2) order by pm.id2');
$in = $req2->fetch_assoc();
$query = $mysqli->query('SELECT users.fname as fname from users,pm where users.user_id=pm.user1');
/*$query = $query->fetch_assoc();*/
if(isset($_POST['message']) and $_POST['message']!='')
{
	$message = $_POST['message'];
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	$message = $mysqli->real_escape_string(nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8')));
	if($mysqli->query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "'.(intval($req2->num_rows)+1).'", "", "'.$myID['user_id'].'", "'.$in['replyTo'].'", "'.$message.'", "'.time().'", "no", "yes")') and $mysqli->query('update pm set user'.$user_partic.'read="yes" where id="'.$id.'" and id2="1"'))
	{
?>
<div class="message">Your reply has successfully been sent.<br />
<a href="readpm.php?id=<?php echo $id; ?>">Go to the PM</a></div>
<?php
	}
	else
	{
?>
<div class="message">An error occurred while sending the reply.<br />
<a href="readpm.php?id=<?php echo $id; ?>">Go to the PM</a></div>
<?php
	}
}
else
{
?>
<div class="content">
<?php
if(isset($_SESSION['email']))
{
$nb_new_pm = $mysqli->query('select count(*) as nb_new_pm from pm where ((user1="'.$myID['user_id'].'" and user1read="no") or (user2="'.$myID['user_id'].'" and user2read="no")) and id2="1"');
$nb_new_pm = $nb_new_pm->fetch_assoc();
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">
	<div class="box_left">
     &gt; <a href="listpm.php">List of your PMs</a> &gt; Read a PM
    </div>
	<div class="box_right">
    	<a href="listpm.php">Your messages(<?php echo $nb_new_pm; ?>)</a> - <a href="home.php?id=<?php echo $_SESSION['email']; ?>"><?php echo htmlentities($_SESSION['email'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Logout</a>)
    </div>
    <div class="clean"></div>
</div>
<?php
}
else
{
?>
<div class="box">
	<div class="box_left">
    &gt; <a href="listpm.php">List of your PMs</a> &gt; Read a PM
    </div>
	<div class="box_right">
    	<a href="signup.php">Sign Up</a> - <a href="login.php">Login</a>
    </div>
    <div class="clean"></div>
</div>
<?php
}
?>
<h1><?php echo $dn1['title']; ?></h1>
<table class="messages_table">
	<tr>
    	<th class="author">User</th>
        <th>Message</th>
    </tr>
<?php
while($dn2 = $req2->fetch_assoc() and $q=$query->fetch_assoc())
{
?>
	<tr>
    	<td class="author center"><?php
/*if($dn2['avatar']!='')
{
	echo '<img src="'.htmlentities($dn2['avatar']).'" alt="Image Perso" style="max-width:100px;max-height:100px;" />';
}*/
?><br /><a href="home.php?id=<?php echo $dn2['userid']; ?>"><?php echo $q['fname']; ?></a></td>
    	<td class="left"><div class="date">Date sent: <?php echo date('Y/m/d H:i:s' ,$dn2['timestamp']); ?></div>
    	<?php echo $dn2['message']; ?></td>
    </tr>
<?php
}
?>
</table><br />
<h2>Reply</h2>
<div class="center">
    <form action="readpm.php?id=<?php echo $id; ?>" method="post">
    	<label for="message" class="center">Message</label><br />
        <textarea cols="40" rows="5" name="message" id="message"></textarea><br />
        <input type="submit" value="Send" onclick="showInput();"/>
    </form>
</div>
</div>
<?php
}
}
else
{
	echo '<div class="message">You don\'t have the right to access this page.</div>';
}
}
else
{
	echo '<div class="message">This message doesn\'t exist.</div>';
}
}
else
{
	echo '<div class="message">The ID of this message is not defined.</div>';
}
}
else
{
?>
<div class="message">You must be logged to access this page.<br>
<a href="login.php">Login First</a></div><!--
<div class="box_login">
	<form action="login.php" method="post">
		<label for="username">Username</label><input type="text" name="username" id="username" /><br />
		<label for="password">Password</label><input type="password" name="password" id="password" /><br />
        <label for="memorize">Remember</label><input type="checkbox" name="memorize" id="memorize" value="yes" />
        <div class="center">
	        <input type="submit" value="Login" /> <input type="button" onclick="javascript:document.location='signup.php';" value="Sign Up" />
        </div>
    </form>
</div>-->
<?php
}
?>
	
	</body>
</html>