<?php
include('home.php');
include('config.php');
$reqFrom = $_GET['id'];
$myid = $mysqli->query('SELECT user_id from users WHERE email="'.$email.'"');
$myid = $myid->fetch_array(MYSQLI_NUM);
$accept = $mysqli->query('UPDATE friends SET status="conekted" WHERE sender="'.$reqFrom.'" and reciever="'.$myid[0].'"');


?>

<html>
<head>
<meta http-equiv="refresh" content="2;URL=conektReq.php?id=<?php echo $email; ?>" />
</head>
</html>