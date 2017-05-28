<html>
<head>
<title>
</title>
<link href="navcss.css" rel="stylesheet" type="text/css" />
</head>

<div class ="header1">

<body background="images/ConnectingPeople.jpg">
<div class="box_right">
<div id="wrapper">
<div id="navmenu">
<ul>
<li><?php echo "  " ?><a href=""><?php echo $a[0]; echo " "; echo $a[1];?></a>
<ul>
<li><a href="<?php $about="about.php"; echo $about;?>">About Me</a></li>
<li><a href="friends.php?id=<?php echo $email; ?>">Connekt</a></li>
<li><a href="<?php $setting ="settings.php"; echo $setting;?>">Settings</a></li>
<li><a href="<?php $logout="logout.php"; echo $logout;?>">Logout</a></li>
</ul>
</li>
</ul>
</div>
</div>
</div>
<div class="box_left">
<!--<div class="header1">-->
<form action="search.php" method="post">

<input type="text" name="search" placeholder="search">

</form>
</div>
</div>
</br></br>
</div>
</body>
</html>