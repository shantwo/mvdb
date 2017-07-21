<?php
include_once "../../inc/functions.php";
include_once "../../inc/config.php";

//IF POST EXIST AND IF SEARCH IS NOT EMPTY
if ( isset( $_POST ) && !empty( $_POST['search'] ) ){
    print( LookFor( $_POST['search'] , $pdo ) );
}

?>
