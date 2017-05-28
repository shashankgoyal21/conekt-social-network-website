<?php 
include('config.php');
include('displayPost.php');
$ds = $_GET['id1'];
$home="home.php";
$userID = $mysqli->query('select user_id from users where email="'.$email.'"');
$id1 = $userID->fetch_assoc();
$post = $mysqli->query('INSERT into users_post(user_id,post,timestamp) values("'.$id1['user_id'].'","'.$ds.'","'.time().'")')
?>
<html>
<head>
<meta http-equiv="refresh" content="2;URL=displayPost.php" /> 
</head>
</html>
