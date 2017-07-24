<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MVDB &#124; Yet Another Movie Collection Manager</title>
        <script lang="javascript" type="text/javascript" src="lib/jquery/jquery-3.2.1.min.js"></script>
        <script lang="javascript" type="text/javascript" src="lib/materialize/js/materialize.min.js"></script>
        <link rel="stylesheet" type="text/css" href="lib/materialize/css/materialize.min.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <nav class="blue-grey darken-2" style="margin-bottom:5%">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo right"><i class="large material-icons">movie</i>MVDB | Yet Another Movie Collection Manager</a>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="list.php">List all movies</a></li>
                    <li><a href="">Genre</a></li>
                    <li><a href="add.php">Add a Movie</a></li>
                    <li>
                        <i class="material-icons">search</i>
                    </li>
                    <li>
                        <form>
                            <div class="input-field">
                                <input id="search" type="search" placeholder="search" required>
                                <i class="material-icons">close</i>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
