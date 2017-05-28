<?php
include('home.php');
include('config.php');
echo $email;
$sender = $_GET['id2'];
$id2 = $mysqli->query('SELECT user_id from users where email="'.$email.'"');
$id2 = $id2->fetch_assoc();

$name=$mysqli->query('select * from users');
$id3=$name->fetch_assoc();
$var = $mysqli->query('insert into friends(sender,reciever,status) values("'.$id2['user_id'].'", "'.$sender.'","waiting")');

?>
<html>
<head>
<meta http-equiv="refresh" content="2;URL=friends.php?id=<?php echo $email?>">
</head>
</html> 