<?php
include('login.php');
include('config.php');
$email = $_SESSION['email'];
ob_clean();
ob_get_contents();
$user_id = $mysqli->query('SELECT user_id from users WHERE email="'.$email.'"');
$user_id = $user_id->fetch_array(MYSQLI_NUM);
echo $email;
if(isset($_POST['create']) )
{
	if($_POST['page_name']!="")
	{
	if($_POST['page_type']!="")	
	 {
	$pname = $_POST['page_name'];
	$ptype = $_POST['page_type'];
		if(get_magic_quotes_gpc())
		{
			$pname= $mysqli->real_escape_string(stripslashes($pname));
			$ptype= $mysqli->real_escape_string(stripslashes($ptype));
		}
		else
		{
			$pname = $mysqli->real_escape_string($pname);
			$ptype = $mysqli->real_escape_string($ptype);
		}
		$total_pages = $mysqli->query('SELECT count(*) from pages');
		$total_pages = $total_pages->fetch_array(MYSQLI_NUM);
		$total_pages[0] = $total_pages[0] + 1;
		$stmt = $mysqli->prepare("INSERT INTO pages(p_id, p_type, p_name, user_id) values(?, ?, ?,?)");
		$stmt->bind_param('sssd', $total_pages[0],$ptype,$pname,$user_id[0]);
		if($stmt){
			$stmt->execute();
		}
		$stmt->close();
		$page="page2.php";
		?>
		<div class="message">
		<a href="<?php echo $page; ?>"> PAGE SUCCESSFULLY CREATED </a><?php
		}
else
	$error = "Choose A typo of your fucking page assHole";
	}
else
	$error = "You Shitty ass TYPE a name";
}
?></div>
<html>
<head><title></title>
<link href="style.css" rel="stylesheet" title="Style" /></head>
<body bgcolor=LIGHTBLUE align="middle">
<script>
/*function WriteFile()
{
var fh = fopen("C:\wamp\www\connekt\pageinfo.txt", 3); 
if(fh!=-1) 
{
    var str = "Some text goes here...";
    fwrite(fh, str);
    fclose(fh); 
}
}*/
</script>
<?php
if(isset($error))
{?>
<div class="message">
<?php
echo "</br>";
	echo $error;
} 
?></div>
<form action="create_page.php" method="post">
<br>
Name: <input type="text" name="page_name" value="<?php if(isset($_POST['page_name'])){ echo htmlentities($_POST['page_name'], ENT_QUOTES, 'UTF-8');}?>" />
<br><br> 
<div>
Type:
<select name="page_type" >
<option value="" name=""> Choose</option>
<option value="Education" name="Education">Education</option>
<option value="Business" name="Business">Buisness</option>
<option value="Enetrtainment" name="Entertainment">Entertainment</option>
<option value="Social" name="Social">Social</option>
</select>
</div>
<br>
<br>About:<br>
<textarea name="comment" rows="5" cols="40"></textarea>
<br>
<input type="submit" name ="create" />
</form>
</body>
</html>