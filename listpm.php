<?php

include('home.php');
include('config.php');
?>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<style.css" rel="stylesheet" title="Style" />
        <title>Personal Messages</title>
    </head>
    <body><br><br><br><br><br><br><br><br><br><br>
        <div class="content">
<?php
if(isset($_SESSION['email']))
{
	$myID = $mysqli->query('SELECT user_id from users WHERE email="'.$email.'"');
		$myID = $myID->fetch_assoc();
$req1 = $mysqli->query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.user_id as userid,users.fname,users.lname from pm as m1, pm as m2,users where ((m1.user1="'.$myID['user_id'].'" and m1.user1read="no" and users.user_id=m1.user2) or (m1.user2="'.$myID['user_id'].'" and m1.user2read="no" and users.user_id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
$req21 = $mysqli->query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.user_id as userid, users.fname, users.lname from pm as m1, pm as m2,users where ((m1.user1="'.$myID['user_id'].'" and m1.user1read="yes" and users.user_id=m1.user2) or (m1.user2="'.$myID['user_id'].'" and m1.user2read="yes" and users.user_id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
$nb_new_pm = $mysqli->query('select count(*) as nb_new_pm from pm where ((user1="'.$myID['user_id'].'" and user1read="no") or (user2="'.$myID['user_id'].'" and user2read="no")) and id2="1"');
$nb_new=$nb_new_pm->fetch_assoc();
$total_message = $nb_new_pm->num_rows;
$nb = $nb_new['nb_new_pm'];
?>
<div class="box">
	<div class="box_left">
    &gt; List of your Personal Messages
    </div>
	<div class="box_right">
    	<a href="listpm.php">Your messages(<?php echo $total_message; ?>)</a> - <a href="home.php?id=<?php echo $_SESSION['email']; ?>"><?php echo htmlentities($_SESSION['email'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="logout.php">Logout</a>)
    </div>
    <div class="clean"></div>
</div>
This is the list of your personal messages:<br />
<a href="newpm.php" class="button">New Personal Message</a><br />
<h3>Unread messages(<?php echo intval($req1->num_rows); ?>):</h3>
<table class="list_pm">
	<tr>
    	<th class="title_cell">Title</th>
        <th>Nb. Replies</th>
        <th>Participant</th>
        <th>Date Sent</th>
    </tr>
<?php
while($dn11 = $req1->fetch_assoc())
{
?>
	<tr>
    	<td class="left"><a href="readpm.php?id=<?php echo $dn11['id']; ?>"><?php echo htmlentities($dn11['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo $dn11['reps']-1; ?></td>
    	<td><a href="home.php?id=<?php echo $dn11['userid']; ?>">
		<?php echo htmlentities($dn11['fname'],ENT_QUOTES, 'UTF-8');?>
		<?php echo " "?>
		<?php echo htmlentities($dn11['lname'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo date('d/m/Y H:i:s' ,$dn11['timestamp']); ?></td>
    </tr>
<?php
}
if(intval($req1->num_rows==0))
{
?>
	<tr>
    	<td colspan="4" class="center">You have no unread message.</td>
    </tr>
<?php
}
?>
</table>
<br />
<h3>Read messages(<?php echo $req21->num_rows; ?>):</h3>
<table class="list_pm">
	<tr>
    	<th class="title_cell">Title</th>
        <th>Nb. Rreplies</th>
        <th>Participant</th>
        <th>Date Sent</th>
    </tr>
<?php
while($dn2 = $req21->fetch_assoc())
{
?>
	<tr>
    	<td class="left"><a href="readpm.php?id=<?php echo $dn2['id']; ?>"><?php echo htmlentities($dn2['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo $dn2['reps']-1; ?></td>
    	<td><a href="profile.php?id=<?php echo $dn2['userid']; ?>"><?php echo htmlentities($dn2['fname'], ENT_QUOTES, 'UTF-8'); ?></a></td>
    	<td><?php echo date('d/m/Y H:i:s' ,$dn2['timestamp']); ?></td>
    </tr>
<?php
}
if(intval($req21->num_rows)==0)
{
?>
	<tr>
    	<td colspan="4" class="center">You have no read message.</td>
    </tr>
<?php
}
?>
</table>
<?php
}
else

{
?>
<h2>You must be logged to access this page:</h2>
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
		</div>
	</body>
</html>