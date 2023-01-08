<!-- admin/error/errorImage/content -->

<?php if (isset($errors)) {

    foreach ($errors as $error) {

        echo "<h1> Image" . $error["id"] . "</h1>";

        echo "<p>" . $error["error"] . "</p>";

    }

} ?>

<!-- admin/error/errorImage/content -->
