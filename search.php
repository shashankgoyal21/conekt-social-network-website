
<?php
include('config.php');
$search = $_SESSION['search'];
ob_get_contents();
ob_clean();
include('home.php');

	//echo $_POST['search'];
	$search = $_POST['search'];
		if(get_magic_quotes_gpc())
		{
			$search= $mysqli->real_escape_string(stripslashes($search));
		}
		else
		{
			$search = $mysqli->real_escape_string($search);
		}?></br><html>
<head>
<link href="navcss.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
	$result1 = $mysqli->query("SELECT * FROM users WHERE fname LIKE '%".$search."%' ");
	?>
	
	<table border="10" style="width:10%">
	<tr>
	<td>
	<div class="message">
	
	<?php
	echo "People Results for "; echo $search;?>
	</div>
	
<?php

while($r = $result1->fetch_assoc())
	{if($email!=$r["email"]){
	?>
	
<div class="message1"><div class ="box_right"><a href="about.php?id=<?php echo $r['email'];?>"><input type="submit" name="view_profile" value="Profile"></a></div>
	</br><?php
	echo $r["fname"]; echo" ";
	echo $r["lname"]; echo"</br>";
	$location = $mysqli->query('SELECT * from location WHERE lid="'.$r["lid"].'"');
	while($l = $location->fetch_assoc())
	{
		echo $l["city"]; 
		echo " "; 
		echo $l["state"];
	}
	}
	?></div>
<?php
	}
	$result2 = $mysqli->query("SELECT * FROM pages WHERE p_name LIKE '$search%' ");
	?>
	
	<table border="10" style="width:10%">
	<tr>
	<td>

	<?php if($result2->num_rows!=0){
		?>
		<div class="message"><?php
	echo " Pages Results for "; echo $search;?>
	</div>

<?php

while($r1 = $result2->fetch_assoc())
	{?>
	
<div class="message1"><div class ="box_right"><a href="like.php?id=<?php echo $r1['p_id']; ?>">LIKE</a></div>
	</br><a href = "page2.php?id=<?php echo $r1['p_id'];?>"><?php
	echo $r1["p_name"]; echo" ";
	?></a></div>
<?php
	}}
	else ?>
	<div class="message">
	<?php
		echo "No Pages Found";
		$result3 = $mysqli->query("SELECT * FROM groups WHERE g_name LIKE '$search%' ");
	?>
	</div>
	<table border="10" style="width:10%">
	<tr>
	<td>
	
	<?php if($result3->num_rows!=0) {?><div class="message">
<?php	echo " Groups Results for "; echo $search;?>
	</div>
	
<?php

while($r2 = $result3->fetch_assoc())
	{?>
	
<div class="message1"><div class ="box_right"></div>
	</br><?php
	echo $r2["g_name"]; echo" ";
	?></div>
<?php
	}
	}
	else ?>
	<div class="message"><?php
echo "No groups Found"	?>
</div>
<?php
$result4= $mysqli->query("SELECT * FROM events WHERE e_name LIKE '$search%' ");
?>	
	<table border="10" style="width:10%">

	
	<?php 
	if($result4->num_rows){?><div class="message"><?php
	echo " Events Results for "; echo $search;?>
	</div>
	<div class ="box_right">
<?php

while($r3 = $result4->fetch_assoc())
	{?>
	
<div class="message1"><div class ="box_right"><input type="submit" name="view_profile" value="Profile"></div>
	</br><?php
	echo $r["e_name"]; echo" ";
	?></div>
<?php
	}
	}
	else ?><div class="message">
<?php echo "No events Found"?></div>