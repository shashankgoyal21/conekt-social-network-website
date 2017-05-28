<?php
include('home.php')
$id = $mysqli->query('select user_id from users where email="'.$email.'"');
$id1=$id->fetch_assoc();
$id2=$mysqli->query('select sender from friends where reciever = "'.$id1['user_id'].'" ');
while($id3=$id2->fetch_assoc())
{
	$name=$mysqli->query('select fname,lname from users where user_id = "'.$id3['sender'].'"');
	echo $name['fname']; echo " " ; echo $['lname'];
	?>
	<input type="submit" value="conekt" name="conekt" />
<input type="submit" value="disconekt" name="disconekt" />
<?php
} ?>

<?php
if(isset($_POST(conekt)))
{
	$a=$mysqli->query('update friends set status="accepted" Where ')

}
else
	$b=$mysqli->query('update friends set status="declined"')
?>
