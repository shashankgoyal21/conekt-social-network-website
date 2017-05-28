<html>
<head>
<title>Settings</title>


<link href="style.css" rel="stylesheet" title="Style">
</head>
<body>
<?php 
include('home.php');
include('config.php');
$email = $_SESSION['email'];
?>
<script type="text/javascript">
function Check(id,id1) {
        document.getElementById(id).style.display="block";
		document.getElementById(id1).style.display="none";
	}
</script>	
</br>

<div class="center" id="edit">Email: &emsp;&emsp;&emsp;&emsp; <?php echo $email;?>
<a href="<?php $new3="new3.php"; echo $new3;?>"> &emsp;&emsp;&emsp;&emsp; Edit</a>
</div>
<form action="new3.php?id=emailss">
<div class="center" id="edit_email" style="display:none">
Email: &emsp;&emsp;&emsp;&emsp;
<input type="text" name="EMail"  id="emailss" placeholder="EMail" value="">
&emsp;&emsp;&emsp;	<input type="submit" name="save" value="Save Changes" >

</div>
</form>
</body>
</html>