<?php
session_start();
if (!isset($_SESSION['photos'])) {
  header("Location: login.php");
  exit;
}
$album = $_GET['album'];
// Path to the existing JSON file
$jsonFilePath = "$album/$album" . "_selected.json";

// Read the JSON data from the file
$jsonData = file_get_contents($jsonFilePath);
// Generate a filename with the current timestamp in asia
date_default_timezone_set('Asia/Kolkata');
$timestamp = date('dm_Hi');
$downloadFileName = $album . "_selected_$timestamp.json";

// Set headers to force download
header('Content-Type: application/json');
header('Content-Disposition: attachment; filename="' . $downloadFileName . '"');
header('Content-Length: ' . strlen($jsonData));

// Output the JSON data
echo $jsonData;
exit;
