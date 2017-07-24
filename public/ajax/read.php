<?php
include_once "../../inc/functions.php";
include_once "../../inc/config.php";

$requestSql = 'SELECT DISTINCT * FROM movie
LEFT JOIN country ON country.cou_id = movie.country_cou_id
LEFT JOIN medium ON medium.med_id = movie.medium_med_id
LEFT JOIN language ON language.lan_id = movie.language_lan_id
WHERE mov_id = :id';

if ( isset( $_POST ) && !empty( $_POST['id'] ) ){
    $resultat = execute_sql_movie( $requestSql , ":id" , $_POST['id'] , $pdo );
    $json = json_encode($resultat);
    print_r( $json );
}
else{
    print_r("php error");
}

?>
