<?php

include_once "../../inc/functions.php";
include_once "../../inc/config.php";

// Get list of films from title field
if (isset($_POST) && !empty($_POST['title'])) {
    print_r (omdbSearch($_POST['title']));
}

// Get film from IMDb ID
if (isset($_POST) && !empty($_POST['imdbId'])) {
    print_r (omdbImdbGet($_POST['imdbId']));
}
?>
