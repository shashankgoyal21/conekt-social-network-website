<?php
include('page2.php');
include('config.php');
$pid = $_GET['id'];
$creater = $mysqli->query('SELECT * from pages p1 WHERE p_id="'.$pid.'"');
$creater = $creater->fetch_assoc();
$myid = $mysqli->query('SELECT user_id from users WHERE email="'.$email.'"');
$myid = $myid->fetch_array(MYSQLI_NUM);
	$check = $mysqli->query('select * from create_pages where p_id="'.$pid.'" and user_id="'.$myid[0].'"');
	$check1 = $check->num_rows;
	if(!$check1){
	$update = $mysqli->query('INSERT into create_pages(p_id,user_id) values("'.$pid.'","'.$myid[0].'")');
	$like = $mysqli->query('SELECT count(*) from create_pages WHERE p_id="'.$pid.'"');
	$like = $like->fetch_array(MYSQLI_NUM);
	$update1 = $mysqli->query('UPDATE pages SET likes = "'.$like[0].'" WHERE p_id="'.$pid.'"');
?><html>
<?php
}
else
{
	$dn = $mysqli->query('SELECT * from create_pages WHERE p_id="'.$pid.'" and user_id="'.$myid[0].'"');
	$dn1 = $dn->num_rows;
	
	$dn = $dn->fetch_assoc();
	if($creater['user_id']!=$dn['user_id']){
	$update1 = $mysqli->query('DELETE from create_pages WHERE user_id="'.$myid[0].'" and p_id="'.$pid.'"');
	$dislike = $mysqli->query('SELECT count(*) from create_pages WHERE p_id="'.$pid.'" ');
	$dislike = $dislike->fetch_array(MYSQLI_NUM);
	$update1 = $mysqli->query('UPDATE pages SET likes = "'.$dislike[0].'" WHERE p_id="'.$pid.'"');
}
}
?>

<head>
<meta http-equiv="refresh" content="2;URL=page2.php?id=<?php echo $pid ?>" />
</head>
</html>