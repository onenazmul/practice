<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $filename = $_FILES['file']['name'];
  move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $filename);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple file upload php</title>
</head>
<body>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name='file'>
    <br><br>
    <input type="submit" value="upload">
  </form>
  
</body>
</html>