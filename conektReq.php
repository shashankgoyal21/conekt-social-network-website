<html>
<head>
<link href="style.css" rel="stylesheet" title="Style" />
</head>
</html>

<?php 
include('config.php');
include('home.php');
$id = $mysqli->query('SELECT user_id FROM users WHERE email="'.$email.'"');
$id = $id->fetch_array(MYSQLI_NUM);
$req = $mysqli->query('SELECT users.fname as fn, users.lname as ln, f1.sender as s FROM friends f1,users WHERE f1.reciever="'.$id[0].'" and f1.sender=users.user_id and f1.status="waiting" ');
while($req1 = $req->fetch_assoc())
{?>
	<table><tr>
	<td align="left" ><?php echo $req1['fn'];echo " ";echo $req1['ln']; ?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <a href="check.php?id=<?php echo $req1['s'];?>">Conekt</a>&emsp;<a href="check1.php?id=<?php echo $req1['s']; ?>">Disconekt</a></td>
	</tr></table>
	<?php
}
if($req->num_rows==NULL)
{
	?>
	<div class="message">No new conekt requests</div>
<?php
}
echo $id[0];
$frnds = $mysqli->query('SELECT * FROM friends WHERE status="conekted" and reciever="'.$id[0].'"');
$frnds1 = $frnds->fetch_assoc();
$frnds2 = $mysqli->query('SELECT * from users WHERE user_id="'.$frnds1['sender'].'"');
while($frnds3 = $frnds2->fetch_assoc())
{
	?>
	<table>
	<tr>
	<td><?php echo $frnds3['fname']; echo " "; echo $frnds3['lname']; ?></td><td></td><td></td></td><td></td><td></td></td><td>Conekted</td><td></td>
	</tr>
	</table>
	<?php 
}
$frnds4 = $mysqli->query('SELECT * from users WHERE user_id in (select reciever from friends where sender="'.$id[0].'" and status="conekted")');
$frnds6 = $mysqli->query('SELECT * from users WHERE user_id in (select sender from friends where reciever="'.$id[0].'" and status="conekted")');
while($frnds5 = $frnds4->fetch_assoc())
{
	//if($flag['user_id']==0)
	?>
	<table>
	<tr>
	<td><?php echo $frnds5['fname']; echo " "; echo $frnds5['lname']; ?></td><td></td><td></td></td><td></td><td></td></td><td>Conekted</td><td></td>
	</tr>
	</table>
	<?php 
}

?>