<?php
$album = $_GET['album'];
$photo = $_GET['photo'];
$fav = file_get_contents("$album/" . "$album" . "_selected.json");
$fav = json_decode($fav);
function sanitize_for_id($string)
{
  return preg_replace('/[^a-zA-Z0-9-_]/', '_', $string);
}
$safe_image = htmlspecialchars($photo); // Make the image name HTML safe
$sanitized_image = sanitize_for_id($photo); // Sanitize the image name for use in IDs
if (!in_array($photo, $fav)) {
  // $fav = array_diff($fav, array($photo));
  // $fav = json_encode($fav);
  // file_put_contents('fav.json', $fav);
  echo "<div id='add_$sanitized_image'><i class='bi bi-heart ms-3 fs-4 text-danger'></i>
                <button class='btn btn-outline-primary btn-sm ms-3 mb-2' hx-get='select.php?album=$album&photo=$safe_image' hx-trigger='click' hx-target='#add_$sanitized_image' hx-swap='outerHTML'>Select</button>
                </div>";
} else {
  // Remove $photo from $fav array
  $fav = array_diff($fav, [$photo]);
  $fav = array_values($fav);
  $fav = json_encode($fav);
  file_put_contents("$album/" . "$album" . "_selected.json", $fav);
  echo "<div id='add_$sanitized_image'><i class='bi bi-heart ms-3 fs-4 text-danger'></i>
                <button class='btn btn-outline-primary btn-sm ms-3 mb-2' hx-get='select.php?album=$album&photo=$safe_image' hx-trigger='click' hx-target='#add_$sanitized_image' hx-swap='outerHTML'>Select</button>
                </div>";
}
