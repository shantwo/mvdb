<?php
include_once "../../inc/functions.php";
include_once "../../inc/config.php";
    $Array_language = List_all_language($pdo);
    $json = json_encode($Array_language);
    print_r( $json );
?>
