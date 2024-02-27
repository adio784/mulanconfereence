<?php

    $db = mysqli_connect('localhost', 'root', '', 'mulan');

    if (!$db) {
        die('Error connecting to database : ' . mysqli_errno());
    }

?>