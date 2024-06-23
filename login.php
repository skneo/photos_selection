<?php
// $section = $_GET['section'];
session_start();
$showAlert = false;
if (isset($_SESSION['photos'])) {
    header("Location: index.php");
    exit;
}
include "password.php";

if (isset($_POST['password'])) {
    if ($_POST['password'] === $password) {
        $_SESSION['photos'] = true;
        header("Location: index.php");
        exit;
    } else {
        $showAlert = true;
        $alertClass = "alert-danger";
        $alertMsg = "Wrong password";
        // header('Location: login.php');
    }
}
?>

<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <title>Login </title>
</head>

<body>
    <center>
        <?php
        if ($showAlert) {
            echo "<div class='alert $alertClass alert-dismissible fade show py-2 mb-0' role='alert'>
                <strong >$alertMsg</strong>
                <button type='button' class='btn-close pb-2' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
        // include 'header.php';

        ?>
        <div class="mt-5 ">
            <form action="login.php" method="post">
                <input type="password" name="password" class="form-control mb-3 mt-5" style="width: 200px;" placeholder="enter password">
                <button type="submit" class="btn btn-primary " style="width: 200px;">Login </button>
            </form>
        </div>

    </center>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js' integrity='sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8' crossorigin='anonymous'></script> -->
</body>

</html>