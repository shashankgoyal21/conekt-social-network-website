<?php
include('config.php');
include('login.php');
$email = $_SESSION['email'];
ob_get_contents();
ob_clean();
include('temp.php');
$fname = $mysqli->query('SELECT fname,lname,user_id FROM users WHERE email="'.$email.'"');
$a = $fname->fetch_array(MYSQLI_NUM);
$post = $mysqli->query('SELECT * from users_post WHERE user_id="'.$a[2].'" order by timestamp desc');
$pages = $mysqli->query('SELECT create_pages.p_id as pid, pages.p_name as myPage from create_pages,pages Where create_pages.user_id="'.$a[2].'" and create_pages.p_id=pages.p_id');
/*$post = $post->fetch_assoc();*/
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" title="Style" />
<title>
HOME
</title>
</head>
<script language="javascript">
function openWindow()
{
	artclass = window.open("/connekt/new2.php","artclasses","location=1 resizable=no, status = 1, scrollbars=0,width=750 height=500");
	artclasses.moveTo(500,200);
}
</script>
<body background="images/ConnectingPeople.jpg">

<div class="content3">
<div class="center">
<?php
	 $id1=$mysqli->query('SELECT user_id FROM users WHERE email="'.$email.'"');
	 $id1=$id1->fetch_array(MYSQLI_NUM);
	 $directory = "uploads/";
$images = $directory . "$id1[0].jpg";
$fname=$mysqli->query('SELECT fname from users WHERE email="'.$email.'"');
$fname=$fname->fetch_array(MYSQLI_NUM);

?>
<div class="round"><!--
<a href ="<?php $upload = "new2.php"; echo "$upload";?>"> -->
<a href="new2.php">
<img src ="<?php echo $images?>" onError="this.src='images/default.jpg';" width="150" height="150"/>
</a>
</div>

<a href = "<?php 
$about="about.php"; 
echo $about;
?> "> <?php echo $fname[0]; ?> </a></br></br>
<a href="displayPost.php"><?php echo "NewsFeeds"?></a></br></br>
<a href="conektReq.php?id=<?php echo $email; ?>"><?php echo "Friends" ?></a></br></br>
<a href="create_group.php"><?php echo "Groups"?></a></br></br>
<a href="<?php $newpm = "newpm.php"; echo $newpm;?>"><?php echo "Messages"?></a></br>

</br>
<a href ="<?php $create_page = "create_page.php"; echo $create_page;?>"> <?php echo "Pages"?> </a></br>
<?php
while($pLiked = $pages->fetch_assoc())
{?><a href="page2.php?id=<?php echo $pLiked['pid']; ?>">
	<?php echo $pLiked['myPage'];?></a>
	<?php echo "<br>";
}
?></a>
</div>
</div></br></br>
<div class="content2">
<div class="center1">
<form action="" method="post">
<input type="text" name="p" id="post">
</br><center><br>
<input type="submit"  name="post" style="width:60; height:30;font-family:Times New Roman;background-color:lightblue;font-style:bold;" onclick="showInput();" value="Post"></center>
</form>
<?php 
if(isset($_POST['post'])){
	if($_POST['p']!=NULL){
?>
<div class="content2">
<div class="box_right">
<a href="post.php?id1=<?php echo $_POST['p']; ?>">Are you sure???YOU WANT TO POST</a>
</div>
</div>
<?php
}}?>

</div>
</div><br><br><br><br>
</body>
</html>