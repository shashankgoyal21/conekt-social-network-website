<?php
include('home.php');
$fname = $mysqli->query('SELECT fname,lname,user_id FROM users WHERE email="'.$email.'"');
$a = $fname->fetch_array(MYSQLI_NUM);
$post = $mysqli->query('SELECT * from users_post WHERE user_id="'.$a[2].'" order by timestamp desc');
while($p = $post->fetch_assoc()){
?>
<table border="1px">
<div align="box_left">
<tr><td><img src ="<?php echo $images?>" onError="this.src='images/default.jpg';" width="40" height="40"/></td><td><a href="">
<?php $name = $mysqli->query('SELECT fname,lname from users WHERE user_id="'.$p['user_id'].'"');
$name = $name->fetch_assoc();
echo $name['fname']; echo" "; echo $name['lname'];?></a><?php
echo "<br>"; echo date('Y/m/d  H:i:s' ,$p['timestamp']); 
 ?></td><td></td><td></td><td></td>
</div>
<tr><td />
<td></td>
</tr><tr>
<td> <?php echo $p['post']; ?> </td>
<td></td><td></td><td></td>
</tr>
</table>
<?php
}
?>