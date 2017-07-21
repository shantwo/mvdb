<?php

//FUNCTION TO EXECUTE pdo
function execute_sql_lookfor( $requestSql , $expression, $pdo ){
    $pdoStatement = $pdo -> prepare( $requestSql );
    $token = '%'.$expression.'%';
    $pdoStatement -> bindValue( ':expression' , $token );
    if ( $pdoStatement -> execute() === false ){
        print_r( $pdoStatement -> errorInfo() );
    }
    else {
        return $pdoStatement -> fetchAll(PDO::FETCH_ASSOC);
    }
}

//FUNCTION TO SEARCH IN THE DB
function LookFor($expression, $pdo){
    $sql_actors = 'SELECT mov_title, mov_actors, mov_id, mov_poster, mov_synopsis FROM movie
        WHERE mov_actors LIKE :expression';
    $sql_directors = 'SELECT mov_directors, mov_title, mov_id, mov_poster, mov_synopsis FROM movie
        WHERE mov_directors LIKE :expression';
    $sql_location = 'SELECT mov_location, mov_title, mov_id, mov_poster, mov_synopsis FROM movie
        WHERE mov_location LIKE :expression';
    $sql_date = 'SELECT mov_release_date, mov_title, mov_id, mov_poster, mov_synopsis FROM movie
        WHERE mov_release_date LIKE :expression';
    $sql_title = 'SELECT mov_title, mov_id, mov_poster, mov_synopsis FROM movie
        WHERE mov_title LIKE :expression';
    $sql_country = 'SELECT cou_name, mov_title, mov_id, mov_poster, mov_synopsis FROM movie
        LEFT JOIN country ON country.cou_id = movie.country_cou_id
        WHERE country.cou_name LIKE :expression';
    $sql_genre = 'SELECT gen_name, mov_title, mov_id, mov_poster, mov_synopsis FROM movie
        LEFT JOIN genre_has_movie ON genre_has_movie.movie_mov_id = movie.mov_id
        LEFT JOIN genre ON genre.gen_id = genre_has_movie.genre_gen_id
        WHERE genre.gen_name LIKE :expression';
    $sql_language = 'SELECT lan_name, mov_title, mov_id, mov_poster, mov_synopsis FROM movie
        LEFT JOIN language ON language.lan_id = movie.language_lan_id
        WHERE language.lan_name LIKE :expression';
    $sql_medium = 'SELECT med_name, mov_title, mov_id, mov_poster, mov_synopsis FROM movie
        LEFT JOIN medium ON medium.med_id = movie.medium_med_id
        WHERE medium.med_name LIKE :expression';

    $ByActors = execute_sql_lookfor( $sql_actors , $expression , $pdo);
    $ByDirectors = execute_sql_lookfor( $sql_directors , $expression , $pdo);
    $ByLocation = execute_sql_lookfor( $sql_location , $expression , $pdo);
    $ByDate = execute_sql_lookfor( $sql_date , $expression , $pdo);
    $ByTitle = execute_sql_lookfor( $sql_title , $expression , $pdo);
    $ByCountry = execute_sql_lookfor( $sql_country , $expression , $pdo);
    $ByGenre = execute_sql_lookfor( $sql_genre , $expression , $pdo);
    $ByLanguage = execute_sql_lookfor( $sql_language , $expression , $pdo);
    $ByMedium = execute_sql_lookfor( $sql_medium , $expression , $pdo);

    $ArrayResultats = array(
        'actors' => $ByActors,
        'directors' => $ByDirectors,
        'location' => $ByLocation,
        'date' => $ByDate,
        'title' => $ByTitle,
        'country' => $ByCountry,
        'genre' => $ByGenre,
        'language' => $ByLanguage,
        'medium' => $ByMedium
    );

    $jayson = json_encode( $ArrayResultats );
    return $jayson;
}

function getLatestEntries() {
    global $pdo;
    $sql = 'SELECT mov_id, mov_title, mov_year, mov_poster
            FROM movie
            ORDER BY mov_id DESC
            LIMIT 4
            ';
    $pdoStatement = $pdo->query($sql);
    if ($pdoStatement === false) {
    	print_r($pdo->errorInfo());
        return false;
    }
    else {
        return $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
}

//function to get the List
function List_all_movies($pdo){
    $requestSql = 'SELECT DISTINCT * FROM movie
    LEFT JOIN country ON country.cou_id = movie.country_cou_id
    LEFT JOIN medium ON medium.med_id = movie.medium_med_id
    LEFT JOIN language ON language.lan_id = movie.language_lan_id';

    $pdoStatement = $pdo -> prepare( $requestSql );
    if ( $pdoStatement -> execute() === false ){
        print_r( $pdoStatement -> errorInfo() );
    }
    else {
        return $pdoStatement -> fetchAll(PDO::FETCH_ASSOC);
    }
}


?>
