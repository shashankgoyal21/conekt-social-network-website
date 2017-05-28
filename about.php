<?php
include('home.php');
include('config.php');
?>
<html>
<head>
<link href="style.css" rel="stylesheet" title="Style" />
<title>
</title>
</head>
<body>

</br></br></br></br></br></br></br></br></br></br></br></br>
<div class="center">
<?php
$lid = $mysqli->query('SELECT * FROM users WHERE email="'.$email.'"');
$lid = $lid->fetch_assoc();
$res = $mysqli->query('SELECT city, state FROM location WHERE lid = "'.$lid["lid"].'"');
$res = $res->fetch_array(MYSQLI_NUM);
echo "Name : "; echo $a[0]; echo " "; echo $a[1]; echo "<br>";
echo "Email: "; echo $lid["email"]; echo "</br>";
echo "Mobile No. : "; echo $lid["mobile_no"]; echo "</br>";
echo "Date of birth: "; echo $lid["dob"]; echo "</br>";
echo "city : "; echo $res[0]; echo "</br>";  echo "State : " ; echo $res[1];

?>
</div>


</body>
</html>