<?php
include('home.php');
include('config.php');
$email = $_GET['id'];
$id2 = $mysqli->query('SELECT user_id from users where email="'.$email.'"');
$id2 = $id2->fetch_assoc();

$name=$mysqli->query('SELECT * from users where user_id in (select reciever from friends WHERE status="conekted" and sender="'.$id2['user_id'].'" ) or user_id in (select sender from friends where status="conekted" and reciever="'.$id2['user_id'].'" )');

while($ns = $name->fetch_assoc()){
	if($ns['email']!=$email){
		?>
		<table>
<tr>
<td><?php echo $ns['fname']; echo " "; echo $ns['lname']; ?></td>
<td><a href="">Connekted</a></td>
</tr>
	<?php
}
}
?>
</table>
<?php
$name1=$mysqli->query('SELECT * from users where user_id not in (select reciever from friends where sender="'.$id2['user_id'].'") and user_id not in (select sender from friends where reciever="'.$id2['user_id'].'") '  );
while($id1 = $name1->fetch_assoc())
{
	if($id1['email']!=$email){
	?>
		<table>
<tr>
<td><?php echo $id1['fname']. " " . $id1['lname']; ?></td>
<td><a href="sendreq.php?id2=<?php echo $id1['user_id'];?>">Connekt</a></td>
</tr>

	<?php
	}
}
?>
</table><?php
$name=$mysqli->query('SELECT * from users where user_id in (select reciever from friends WHERE status="disconekted" and user_id="'.$id2['user_id'].'") or user_id in (select sender from friends where status="disconekted" and user_id="'.$id2['user_id'].'")');
while($ns = $name->fetch_assoc()){
	if($ns['email']!=$email){
		?>
<table border="2" align="center" >
<tr>
<td align="center"><?php echo $ns['fname']." ". $ns['lname']; ?>
<td align="center"><a href="delete.php?id=<?php $ns['user_id']; ?>">Disconnekted</a>
</tr>
</table>
	<?php
}
}


$name2=$mysqli->query('SELECT * from users where user_id in (select reciever from friends WHERE status="waiting" and sender="'.$id2['user_id'].'") or user_id in (select sender from friends where status="waiting" and reciever="'.$id2['user_id'].'")');
while($ns5 = $name2->fetch_assoc()){
	if($ns5['email']!=$email){
		?>
<table border="2" align="center" >
<tr>
<td align="center"><?php echo $ns5['fname']." ". $ns5['lname']; ?>
<td align="center"><a href="delete.php?id=<?php $ns['user_id']; ?>">Friend Request Sent</a>
</tr>
</table>
	<?php
}
}
?>
