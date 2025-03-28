<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if ($_POST["label"]) {
      $label = $_POST["label"];
  }
  $allowedExts = array("gif", "jpeg", "jpg", "png");
  $temp = explode(".", $_FILES["file"]["name"]);
  $extension = end($temp);
  if ((($_FILES["file"]["type"] == "image/gif")
  || ($_FILES["file"]["type"] == "image/jpeg")
  || ($_FILES["file"]["type"] == "image/jpg")
  || ($_FILES["file"]["type"] == "image/pjpeg")
  || ($_FILES["file"]["type"] == "image/x-png")
  || ($_FILES["file"]["type"] == "image/png"))
  && ($_FILES["file"]["size"] < 200000)
  && in_array($extension, $allowedExts)) {
      if ($_FILES["file"]["error"] > 0) {
          echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
      } else {
          $filename = $label.$_FILES["file"]["name"];
          echo "Upload: " . $_FILES["file"]["name"] . "<br>";
          echo "Type: " . $_FILES["file"]["type"] . "<br>";
          echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
          echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

          if (file_exists("uploads/" . $filename)) {
              echo $filename . " already exists. ";
          } else {
              move_uploaded_file($_FILES["file"]["tmp_name"],
              "uploads/" . $filename);
              echo "Stored in: " . "uploads/" . $filename;
          }
      }
  } else {
      echo "Invalid file";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload Form</title>
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript">
        function submitForm() {
            console.log("submit event");
            var fd = new FormData(document.getElementById("fileinfo"));
            fd.append("label", "WEBUPLOAD");
            $.ajax({
              url: "upload.php",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
                console.log("PHP Output:");
                console.log( data );
            });
            return false;
        }
    </script>
</head>

<body>
    <form method="post" id="fileinfo" name="fileinfo" onsubmit="return submitForm();">
        <label>Select a file:</label><br>
        <input type="file" name="file" required accept="image/*"/>
        <input type="submit" value="Upload" />
    </form>
    <div id="output"></div>
</body>
</html>