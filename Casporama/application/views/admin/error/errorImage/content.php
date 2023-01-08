<!-- admin/error/errorImage/content -->

<?php if (isset($errors)) {

    if (is_array($errors)) {

        foreach ($errors as $error) {

            echo "<h1> Image" . $error["id"] . "</h1>";
    
            echo "<p>" . $error["error"] . "</p>";
    
        }

    } else {

        echo "<p>" . $errors . "</p>";

    }
} ?>

<!-- admin/error/errorImage/content -->
