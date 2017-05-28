<style>
.sucess{
color:#088A08;
}
.error{
color:red;
}
</style>
 
<?php
include('new  1.php');
include('config.php');
ob_clean();
$file_exts = array("jpg", "bmp", "jpeg", "gif", "png");
$upload_exts = end(explode(".", $_FILES["file"]["name"]));
if (( ($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($upload_exts, $file_exts))
{
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
}
else
{
echo "Upload: " . $_FILES["file"]["name"] . "<br>";
echo "Type: " . $_FILES["file"]["type"] . "<br>";
echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
// Enter your path to upload file here
if (file_exists("c:\wamp\www\upload/newupload/" .
$_FILES["file"]["name"]))
{
echo "<div class='error'>"."(".$_FILES["file"]["name"].")".
" already exists. "."</div>";
}
else
{
move_uploaded_file($_FILES["file"]["tmp_name"],
"c:\wamp\www\upload/newupload/" . $_FILES["file"]["name"]);
echo "<div class='sucess'>"."Stored in: " .
"c:\wamp\www\upload/newupload/" . $_FILES["file"]["name"]."</div>";
}
}
}
else
{
echo "<div class='error'>Invalid file</div>";
}
?>