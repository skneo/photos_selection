<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo strtoupper($_GET['album']) ?> All Photos</title>
    <!-- Bootstrap CSS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
</head>

<body>
    <?php
    $album = $_GET['album'];
    include 'navbar.php'; ?>
    <div class="container my-3">
        <?php
        // Define the directory where photos are stored
        $photosDirectory = $album;
        // Check if fav.json exists or is empty
        if (!file_exists("$album/" . "$album" . "_selected.json")) {
            // Create fav.json with []
            file_put_contents("$album/" . "$album" . "_selected.json", "[]");
        }
        $fav = file_get_contents("$album/" . "$album" . "_selected.json");
        $fav = json_decode($fav);
        // Scan the directory for image files
        $files = scandir($photosDirectory);
        // Filter out non-image files (you may add more image extensions as needed)
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $imageFiles = array_filter($files, function ($file) use ($imageExtensions) {
            $info = pathinfo($file);
            return in_array(strtolower($info['extension']), $imageExtensions);
        });

        // Pagination setup
        $perPage = 50; // Number of images per page
        $totalImages = count($imageFiles);
        $totalPages = ceil($totalImages / $perPage);

        // Determine current page number
        $current = isset($_GET['page']) ? $_GET['page'] : 1;
        if (!is_numeric($current) || $current > $totalPages || $current < 1) {
            $current = 1;
        }

        // Calculate starting point for fetching images
        $start = ($current - 1) * $perPage;
        $end = $start + $perPage;

        // Slice the array to get images for the current page
        $imagesToShow = array_slice($imageFiles, $start, $perPage);

        // Display images
        echo "<h3>All " . strtoupper($album) . " photos ($totalImages)</h3>";
        echo '<div class="gallery">';
        $i = 0;
        function sanitize_for_id($string)
        {
            return preg_replace('/[^a-zA-Z0-9-_]/', '_', $string);
        }
        foreach ($imagesToShow as $image) {
            $i++;
            $photolabel = $i + ($current - 1) * 50;
            $photoClass = '';
            if (in_array($image, $fav)) {
                $favImg = true;
                $photoClass = 'mybg-color';
            } else {
                $favImg = false;
            }
            // echo '<div class="image">';
            // echo '<img src="' . $photosDirectory . $image . '" alt="' . $image . '" />';
            // echo '</div>';
            echo "<div class='show-photos d-flex justify-content-center mb-3'>
                    <div class='border $photoClass' style='max-width: 600px;'>
                    <label class='ms-2'>Photo no $photolabel</label>
                        <img src='$album/$image' alt='photo...' class='img-fluid py-2' loading='lazy'>";
            $safe_image = htmlspecialchars($image); // Make the image name HTML safe
            $sanitized_image = sanitize_for_id($image); // Sanitize the image name for use in IDs

            if ($favImg) {
                echo "<div id='rem_$sanitized_image'><i class='bi bi-heart-fill ms-3 fs-4 text-danger'></i>
                <button class='btn btn-outline-primary btn-sm ms-3 mb-2' hx-get='unselect.php?album=$album&photo=$safe_image' hx-trigger='click' hx-target='#rem_$sanitized_image' hx-swap='outerHTML'>Unselect</button>
                </div>";
            } else {
                echo "<div id='add_$sanitized_image'><i class='bi bi-heart ms-3 fs-4 text-danger'></i>
                <button class='btn btn-outline-primary btn-sm ms-3 mb-2' hx-get='select.php?album=$album&photo=$safe_image' hx-trigger='click' hx-target='#add_$sanitized_image' hx-swap='outerHTML'>Select</button>
                </div>";
            }
            echo "</div>";
            echo "</div>";
        }

        echo '</div>';

        // Pagination links
        echo '<div class="pagination">';
        if ($current > 1) {
            echo "<a href=\"all_photos.php?album=$album&page=" . ($current - 1) . '" class="mx-2 mb-2 btn btn-sm btn-outline-primary">Previous</a>';
        }
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($current == $i) {
                echo $i;
            } else {
                echo "<a href=\"all_photos.php?album=$album&page=" . $i . '" class="mx-2 mb-2 btn btn-sm btn-outline-primary">' . $i . '</a>';
            }
        }
        if ($current < $totalPages) {
            echo "<a href=\"all_photos.php?album=$album&page=" . ($current + 1) . '" class="mx-2 mb-2 btn btn-sm btn-outline-primary">Next</a>';
        }
        echo '</div>';
        ?>
        <a href="#" class="moveToTop fs-1" title="Go to top"><i class="bi bi-arrow-up-circle-fill text-warning"></i></a>
    </div>
    <style>
        .mybg-color {
            background-color: #ffccff;
        }

        .moveToTop {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/htmx.org@2.0.0"></script>
</body>

</html>