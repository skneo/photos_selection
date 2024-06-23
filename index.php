<?php
session_start();
if (!isset($_SESSION['photos'])) {
  header("Location: login.php");
  exit;
}
?>
<!doctype html>
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <!-- Bootstrap CSS -->
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
  <title>Photos Selection</title>
</head>

<body>
  <div class="bg-dark text-light text-center h4 py-3" style="position:sticky; top: 0;">Photos Selection</div>
  <div>

    <a href="change_password.php" class=' btn btn-outline-primary btn-sm mx-3'>Change Password</a>
    <a href="logout.php" class=' btn btn-outline-danger btn-sm mx-3'>Logout</a>
  </div>
  <div class="container my-3  text-center ">
    <h4>All Albums</h4><br>
    <center>
      <div class="container col-xs-8 col-md-3">
        <?php
        // $lockStatus = file_get_contents("lockStatus.json");
        // $lockStatus = json_decode($lockStatus, true);
        // $totalEmployees = 0;
        foreach (glob('./*', GLOB_ONLYDIR) as $dir) {
          $dirname = basename($dir);
          // if ($dirname == 'zip_files')
          //   continue;
          $displayDir = strtoupper(($dirname));
          // $employees = file_get_contents("$dirname/employees.json");
          // $employees = json_decode($employees, true);
          // $totalEmployees = $totalEmployees + count($employees);
          // $btnClass = 'btn-outline-primary';
          // if (array_key_exists($dirname, $lockStatus)) {
          //   if ($lockStatus[$dirname] == 1) {
          //     $btnClass = 'btn-success';
          //     $displayDir = $displayDir . " - <i class='bi bi-lock'></i>";
          //   }
          // }
          echo "<a href='all_photos.php?album=$dirname' class='mb-3 btn btn-outline-primary w-100'>$displayDir</a><br>";
        }
        ?>
      </div>
      <?php
      // echo "Total Employees: $totalEmployees";
      ?>
    </center>
  </div>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>
</body>

</html>