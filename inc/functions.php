<?php

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

 ?>
