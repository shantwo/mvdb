<?php

include dirname(dirname(__FILE__))."/inc/config.php";
include "../view/header.php";

// Submit?
if (!empty($_POST)) {
    $title = filterStringInputPost('mov_title');
    $country = filterIntInputPost('cou_id');
    $language = filterIntInputPost('lan_id');
    $year = filterIntInputPost('mov_year');
    $genre = filterIntInputPost('gen_id');
    $runtime = filterIntInputPost('mov_run_time');
    $director = filterStringInputPost('mov_directors');
    $actors = filterStringInputPost('mov_actors');
    $releaseDate = date('Y-m-d', strtotime(filterStringInputPost('mov_release_date')));
    $imdbRating = filterIntInputPost('mov_imdb_rating');
    $medium = filterIntInputPost('med_id');
    $location = filterStringInputPost('mov_location');
    $poster = filterStringInputPost('mov_poster');
    $synopsis = filterStringInputPost('mov_synopsis');
    $note = filterStringInputPost('mov_note');

    // Check for empty mandatory fields
    $errorList = array();

    if (empty($title)) {
        $errorList[] = "Title can't be empty";
    }
    if (empty($country)) {
        $errorList[] = "Country can't be empty";
    }
    if (empty($medium)) {
        $errorList[] = "Medium can't be empty";
    }
    if (empty($language)) {
        $errorList[] = "Title can't be empty";
    }

    // If everything's fine
    if (empty($errorList)) {
        $sql = 'INSERT INTO movie
                -- (mov_title, country_cou_id, language_lan_id, mov_year, genre_gen_id, mov_run_time,
                (mov_title, country_cou_id, language_lan_id, mov_year, mov_run_time,
                mov_directors, mov_actors, mov_release_date, mov_imdb_rating, medium_med_id,
                mov_location, mov_poster, mov_synopsis, mov_note)
                VALUES
                -- (:mov_title, :country_cou_id, :language_lan_id, :mov_year, :genre_gen_id, :mov_run_time,
                (:mov_title, :country_cou_id, :language_lan_id, :mov_year, :mov_run_time,
                :mov_directors, :mov_actors, :mov_release_date, :mov_imdb_rating, :medium_med_id,
                :mov_location, :mov_poster, :mov_synopsis, :mov_note)
        ';

        $sth = $pdo->prepare($sql);
        $sth->bindValue(':mov_title', $title);
        $sth->bindValue(':country_cou_id', $country, PDO::PARAM_INT);
        $sth->bindValue(':language_lan_id', $language, PDO::PARAM_INT);
        $sth->bindValue(':mov_year', $year);
        $sth->bindValue(':mov_run_time', $runtime);
        $sth->bindValue(':mov_directors', $director);
        $sth->bindValue(':mov_actors', $actors);
        $sth->bindValue(':mov_release_date', $releaseDate);
        $sth->bindValue(':mov_imdb_rating', $imdbRating);
        $sth->bindValue(':medium_med_id', $medium, PDO::PARAM_INT);
        $sth->bindValue(':mov_location', $location);
        $sth->bindValue(':mov_poster', $poster);
        $sth->bindValue(':mov_synopsis', $synopsis);
        $sth->bindValue(':mov_note', $note);

        if ($sth->execute() === false) {
            print_r($sth->errorInfo());
        }
        else {
            $movieId = $pdo->lastInsertId();
        }

        // Add the genre to database
        if (!empty($genre)) {
            $sql = 'INSERT INTO genre_has_movie
                    (genre_gen_id, movie_mov_id)
                    VALUES
                    (:genre_gen_id, :movie_mov_id)
                    ';

            $sth = $pdo->prepare($sql);
            $sth->bindValue(':genre_gen_id', $genre, PDO::PARAM_INT);
            $sth->bindValue(':movie_mov_id', $movieId, PDO::PARAM_INT);

            if ($sth->execute() === false) {
                print_r($sth->errorInfo());
            }

        }

        header('Location: list.php');
        // exit;
    }
    else {
        print_r($errorList);
    }
}

// Populate the drop-downs
$genre = getGenreList();
$languages = getLanguages();
$countries = getCountries();
$media = getMedia();

include "../view/add.php";
include "../view/footer.php";

?>
