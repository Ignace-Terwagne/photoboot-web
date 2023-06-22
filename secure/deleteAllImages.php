<?php
$images = glob('../uploads/*.jpg');
foreach ($images as $image) {
    unlink($image);
}
?>