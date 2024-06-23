<?php
$album = $_GET['album'];
$photo = $_GET['photo'];
$fav = file_get_contents("$album/" . "$album" . "_selected.json");
$fav = json_decode($fav);
$safe_image = htmlspecialchars($photo); // Make the image name HTML safe
// Remove $photo from $fav array
$fav = array_diff($fav, [$photo]);
$fav = array_values($fav);
$fav = json_encode($fav);
file_put_contents("$album/" . "$album" . "_selected.json", $fav);
echo "<i class='bi bi-heart ms-3 fs-4 text-danger'></i>
    <button class='btn btn-outline-primary btn-sm ms-3 mb-2' hx-get='select.php?album=$album&photo=$safe_image' hx-trigger='click' hx-target='closest .heart-div'>Select</button>";
