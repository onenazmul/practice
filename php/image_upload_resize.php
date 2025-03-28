<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  function uploadImage($rawfile)
  {
    // $rawfile = $_FILES['image'];
    // echo $rawfile['size'];
    if($rawfile["name"])
    {
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($rawfile["name"]);
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      $resizeFileName = time();
      $upload = 1;
  
      if($rawfile["size"] > 20000000)
      {
        echo 'File size max 2MB';
        $upload = 0;
      }
  
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif")
      {
        echo 'Image format does not match';
        $upload = 0;
      }
  
      if($upload == 1)
      {  
        $raw_image = $rawfile['tmp_name'];
        $image_size = getimagesize($raw_image);
      
        $ratio = 0;
        $img_width = 1200;
        $img_height = 1200;
      
        if($image_size[0] > $image_size[1] && $image_size[0] > $img_width)
        {
          $ratio = $image_size[0] / $image_size[1];
          $img_height = round($img_width / $ratio);
        }
        elseif($image_size[1] > $image_size[0] && $image_size[1] > $img_height)
        {
          $ratio = $image_size[1] / $image_size[0];
          $img_width = round($img_height / $ratio);
        }
        else
        {
          $img_width = $image_size[0];
          $img_height = $image_size[1];
        }

        $resourceType = @imagecreatefromjpeg($raw_image);
        if($resourceType !== false)
        {
          $imageLayer = imagecreatetruecolor($img_width, $img_height);

          imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $img_width, $img_height, $image_size[0], $image_size[1]);
          
          imagejpeg($imageLayer, $target_dir . $resizeFileName.'_' .$rawfile["name"]);
        }
        else
        {
          echo 'Please select valid image.';
        }
    
        echo $target_dir . $resizeFileName.'_' .$rawfile["name"];
      }
    }
  }

  if(isset($_FILES['image']))
  {
    $upload = uploadImage($_FILES['image']);
    var_dump($upload);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Image upload and resize</title>
</head>
<body>
  <hr>
  <form action="" method="post" enctype="multipart/form-data">
    <label for="">Upload Image</label><br><br>
    <input type="file" name="image"><br><br>
    <input type="submit" value="submit">
  </form>
  
</body>
</html>