<div class="d-flex bg-dark py-3 sticky-top">
  <a class="mx-2 active text-light" aria-current="page" href="index.php">Home</a>
  <a class="mx-2 active text-light" aria-current="page" href="all_photos.php?album=<?php echo $album ?>"><?php echo strtoupper($album) ?></a>
  <a class="mx-2 active text-light" aria-current="page" href="all_photos.php?album=<?php echo $album ?>">All</a>
  <a class="mx-2 active text-light" aria-current="page" href="selected.php?album=<?php echo $album ?>">Selected</a>
  <a class="mx-2 active text-light" aria-current="page" href="logout.php">Logout</a>
</div>