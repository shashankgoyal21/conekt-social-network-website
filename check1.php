<?php
include('home.php');
include('config.php');
$reqFrom = $_GET['id'];
$myid = $mysqli->query('SELECT user_id from users WHERE email="'.$email.'"');
$myid = $myid->fetch_array(MYSQLI_NUM);
$decline = $mysqli->query('UPDATE friends SET status="disconekted" WHERE sender="'.$reqFrom.'" and reciever="'.$myid[0].'"');
$chk = $mysqli->query('DELETE FROM friends WHERE status="disconekted"');
?>
<html>
<head>
<meta http-equiv="refresh" content="2;URL=conektReq.php?id=<?php echo $email; ?>" />
</head>
</html>