<?php
include_once "../../inc/functions.php";
include_once "../../inc/config.php";

if ( isset( $_POST ) && !empty( $_POST['id'] ) ){
    print( execute_sql_movie( $requestSql , ":id" , $_POST['id'] , $pdo ) );
}


function execute_sql_movie( $requestSql , $token , $variable , $pdo ){

    $requestSql = 'SELECT DISTINCT * FROM movie
    LEFT JOIN country ON country.cou_id = movie.country_cou_id
    LEFT JOIN medium ON medium.med_id = movie.medium_med_id
    LEFT JOIN language ON language.lan_id = movie.language_lan_id
    WHERE mov_id = :id';

    $pdoStatement = $pdo -> prepare( $requestSql );
    $pdoStatement -> bindValue( $token , $variable );
    if ( $pdoStatement -> execute() === false ){
        print_r( $pdoStatement -> errorInfo() );
    }
    else {
        return $pdoStatement -> fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
