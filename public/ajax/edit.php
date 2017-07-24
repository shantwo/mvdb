<?php
include_once "../../inc/functions.php";
include_once "../../inc/config.php";

$title = $_POST['title'];
$actors = $_POST['actors'];
$directors = $_POST['directors'];
$id = $_POST['id'];
$language = $_POST['language'];
$location = $_POST['location'];
$medium = $_POST['medium'];
$note = $_POST['note'];
$poster = $_POST['poster'];
$run_time = $_POST['run_time'];
$synopsis = $_POST['synopsis'];
$year = $_POST['year'];

//RECUPERATION DE LA LANGUE
$requestSql = 'SELECT lan_id
                FROM language
                WHERE lan_name = :language';
$pdoStatement = $pdo -> prepare( $requestSql );
$pdoStatement -> bindValue( ':language' , $language );
if ( $pdoStatement -> execute() === false ){
    print_r( $pdoStatement -> errorInfo() );
}
else {
    $result =  $pdoStatement -> fetch(PDO::FETCH_ASSOC);
    $language = $result['lan_id'];
}


//RECUPERATION DU MEDIUM
$requestSql = 'SELECT med_id
                FROM medium
                WHERE med_name = :medium';
$pdoStatement = $pdo -> prepare( $requestSql );
$pdoStatement -> bindValue( ':medium' , $medium );
if ( $pdoStatement -> execute() === false ){
    print_r( $pdoStatement -> errorInfo() );
}
else {
    $result =  $pdoStatement -> fetch(PDO::FETCH_ASSOC);
    $medium = $result['med_id'];
}

//insertion dans la table
$sql = 'UPDATE movie
        SET mov_title = :title, mov_year = :year, mov_location = :location, mov_actors = :actors, mov_synopsis = :synopsis, mov_run_time = :runtime, mov_directors = :directors, mov_note = :note, mov_poster = :poster, language_lan_id = :language, medium_med_id = :medium
        WHERE mov_id = :id';
$pdoStatement = $pdo -> prepare( $sql );
$pdoStatement -> bindValue( ':id' , $id );
$pdoStatement -> bindValue( ':title' , $title );
$pdoStatement -> bindValue( ':year' , $year );
$pdoStatement -> bindValue( ':location' , $location );
$pdoStatement -> bindValue( ':actors' , $actors );
$pdoStatement -> bindValue( ':synopsis' , $synopsis );
$pdoStatement -> bindValue( ':runtime' , $run_time );
$pdoStatement -> bindValue( ':directors' , $directors );
$pdoStatement -> bindValue( ':note' , $note );
$pdoStatement -> bindValue( ':poster' , $poster );
$pdoStatement -> bindValue( ':language' , $language );
$pdoStatement -> bindValue( ':medium' , $medium );
if ( $pdoStatement -> execute() === false ){
    print_r( $pdoStatement -> errorInfo() );
}




?>
