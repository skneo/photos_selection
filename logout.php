<?php
$section = $_GET['section'];
session_start();
session_destroy();
header("Location: login.php");
