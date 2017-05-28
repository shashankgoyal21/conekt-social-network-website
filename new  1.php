<?php
include('config.php');
?>
<html>
<head>
<link href="style.css" rel="stylesheet" title="Style" />
        <title >Upload</title>
    </head>
<body>
<div class="content">
<div class = "center">
<form action="upload.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>
<!--
<form action="upload1.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload"></br></br>
    <input type="submit" value="Upload Image" name="submit">
</form>-->

</div>
</div>

</body>
</html>