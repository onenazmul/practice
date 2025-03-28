<?php
$imageSize = (object)$imgSize = getimagesize('blog-image.jpg');
print_r($imgSize);
echo '<hr>';
echo $imgSize[0];
?>