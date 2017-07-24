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

// Function to return the latest entries
function getLatestEntries($limit = 4) {
    global $pdo;
    $sql = 'SELECT mov_id, mov_title, mov_year, mov_poster
            FROM movie
            ORDER BY mov_id DESC
            LIMIT '.$limit.'
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

// Function to return the used categories
function getUsedGenreList($limit = 0) {
    global $pdo;
    $sql = 'SELECT gen_name, mov_id, mov_title, gen_id, COUNT(DISTINCT mov_id) AS mov_count
            FROM movie
            LEFT OUTER JOIN genre_has_movie
            ON mov_id = movie_mov_id
            LEFT OUTER JOIN genre
            ON gen_id = genre_gen_id
            GROUP BY gen_id
            ORDER BY mov_count DESC
            LIMIT '.$limit.'
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

// Function to return the complete categories list
function getGenreList() {
    global $pdo;
    $sql = 'SELECT gen_id, gen_name
            FROM genre
            ORDER BY gen_name ASC
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

// Function to return the language list
function getLanguages() {
    global $pdo;
    $sql = 'SELECT lan_id, lan_name
            FROM language
            ORDER BY lan_name ASC
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

// Function to return the country list
function getCountries() {
    global $pdo;
    $sql = 'SELECT cou_id, cou_name
            FROM country
            ORDER BY cou_name ASC
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

// Function to return the media list
function getMedia() {
    global $pdo;
    $sql = 'SELECT med_id, med_name
            FROM medium
            ORDER BY med_name ASC
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

//function for ajax : read
function execute_sql_movie( $requestSql , $token , $variable , $pdo ){
    $pdoStatement = $pdo -> prepare( $requestSql );
    $pdoStatement -> bindValue( $token , $variable );
    if ( $pdoStatement -> execute() === false ){
        print_r( $pdoStatement -> errorInfo() );
    }
    else {
        return $pdoStatement -> fetchAll(PDO::FETCH_ASSOC);
    }
}

// String filter function for POST
function filterStringInputPost($name, $defaultValue='') {
	$getValue = filter_input(INPUT_POST, $name);
	if ($getValue !== false) {
		return trim(strip_tags($getValue));
	}
	return $defaultValue;
}

// Integer filter function for POST
function filterIntInputPost($name, $defaultValue=0) {
	$getValue = filter_input(INPUT_POST, $name);
	if ($getValue !== false) {
		return intval(trim($getValue));
	}
	return $defaultValue;
}

// Return OMDb search from title (s=)
function omdbSearch($search) {
    $ch = curl_init(); // Init curl resource
    curl_setopt($ch, CURLOPT_URL, "http://www.omdbapi.com/?s=".$search."&apikey=ec6483bd"); // set url
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return the transfer as a string
    $output = curl_exec($ch);
    return json_decode(curl_exec($ch), true); // Get the string and make it a json
}

// Return OMDb particular title froé IMDb ID (i=)
function omdbImdbGet($imdbId) {
    $ch = curl_init(); // Init curl resource
    curl_setopt($ch, CURLOPT_URL, "http://www.omdbapi.com/?i=".$imdbId."&apikey=ec6483bd"); // set url
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return the transfer as a string
    $output = curl_exec($ch);
    return json_decode(curl_exec($ch), true); // Get the string and make it a json
}

?>
