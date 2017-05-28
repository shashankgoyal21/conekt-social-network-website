<?php
include('config.php');
ob_get_contents();

include('home.php');
echo $_POST['pages'];
?><html>
<head>
<link href="navcss.css" rel="stylesheet" type="text/css" />
</head>
<body>

</br><div align="middle">
	<div class="vertical-line">
	<input type="submit" value="People" name="people">&emsp;
	<input type="submit" value="Pages" name="pages">&emsp;
	<input type="submit" value="Groups" name="groups">&emsp;
	<input type="submit" value="Events" name="events">&emsp;
	</div></div>
 
<?php
echo "page-search";
if(isset($_POST['pages'])){
		$result1 = $mysqli->query("SELECT * FROM pages WHERE p_name LIKE '$search%' ");
	?>
	
	</div>
	<table border="10" style="width:10%">
	<tr>
	<td>
	<div class="message">
	<?php echo " Pages Results for "; echo $search;?>
	</div>
	<div class ="box_right">
<?php

while($r = $result1->fetch_assoc())
	{?>
	
<div class="message1"><div class ="box_right"><input type="submit" name="view_profile" value="Profile"></div>
	</br><?php
	echo $r["p_name"]; echo" ";
	?></div>
<?php
	}
}
/*
	if(isset($_POST['groups'])){
		$result1 = $mysqli->query("SELECT * FROM groups WHERE g_name LIKE '$search%' ");
	?>
	
	</div>
	<table border="10" style="width:10%">
	<tr>
	<td>
	<div class="message">
	<?php echo " Groups Results for "; echo $search;?>
	</div>
	<div class ="box_right">
<?php

while($r = $result1->fetch_assoc())
	{?>
	
<div class="message1"><div class ="box_right"><input type="submit" name="view_profile" value="Profile"></div>
	</br><?php
	echo $r["g_name"]; echo" ";
	?></div>
<?php
	}
	}
	else{
		//echo "no groups"
	}
	if(isset($_POST['events'])){
		$result1 = $mysqli->query("SELECT * FROM events WHERE e_name LIKE '$search%' ");
	?>
	
	</div>
	<table border="10" style="width:10%">

	<div class="message">
	<?php echo " Events Results for "; echo $search;?>
	</div>
	<div class ="box_right">
<?php

while($r = $result1->fetch_assoc())
	{?>
	
<div class="message1"><div class ="box_right"><input type="submit" name="view_profile" value="Profile"></div>
	</br><?php
	echo $r["e_name"]; echo" ";
	?></div>
<?php
	}
	}
	else{
		//echo "no events"
	}*/