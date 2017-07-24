<script lang="javascript" type="text/javascript" src="js/list_modal_init.js"></script>

<div class="row">
    <form class="col s12" action="add.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s6">
                <input  name="mov_title" id="movieTitle" type="text" class="validate">
                <label for="movieTitle">Title</label>
            </div>
            <div class="input-field col s1">
                <select name="cou_id" id="movieCountry">
                    <option value="" disabled selected>Select a country</option>
                    <?php foreach ($countries as $currentValue) : ?>
                        <option value="<?= $currentValue["cou_id"] ?>"><?= $currentValue["cou_name"] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="movieCountry">Country</label>
            </div>
            <div class="input-field col s1">
                <select name="lan_id" id="movieLanguage">
                    <option value="" disabled selected>Select a language</option>
                    <?php foreach ($languages as $currentValue) : ?>
                        <option value="<?= $currentValue["lan_id"] ?>"><?= $currentValue["lan_name"] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="movieLanguage">Language</label>
            </div>
            <div class="input-field col s1">
                <select name="mov_year" id="movieYear">
                    <option value="" disabled selected>Select a year</option>
                    <?php for ($i = date('Y'); $i >= 1900; $i--) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
                <label for="movieYear">Year</label>
            </div>
            <div class="input-field col s1">
                <select name="gen_id" id="movieGenre">
                    <option value="" disabled selected>Select a genre</option>
                    <?php foreach ($genre as $currentValue) : ?>
                        <option value="<?= $currentValue["gen_id"] ?>"><?= $currentValue["gen_name"] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="movieGenre">Genre</label>
            </div>
            <div class="input-field col s1">
                <input name="mov_run_time" name="" id="movieRuntime" type="text" class="validate">
                <label for="movieRuntime">Enter Runtime</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s3">
                <input name="mov_directors" id="movieDirector" type="text" class="validate">
                <label for="movieDirector">Director</label>
            </div>
            <div class="input-field col s8">
                <input name="mov_actors" id="movieActors" type="text" class="validate">
                <label for="movieDirector">Actors</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s1">
                <input name="mov_release_date" id="movieReleaseDate" type="text" class="datepicker">
                <label for="movieReleaseDate">Release Date</label>
            </div>
            <div class="input-field col s1">
                <input name="mov_imdb_rating" value="" id="movieImdbRating" type="text" class="validate">
                <label for="movieImdbRating">IMDb Rating</label>
            </div>
            <div class="input-field col s1">
                <select name="med_id" id="movieMedium">
                    <option value="" disabled selected>Enter the format</option>
                    <?php foreach ($media as $currentValue) : ?>
                        <option value="<?= $currentValue["med_id"] ?>"><?= $currentValue["med_name"] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="movieMedium">Medium</label>
            </div>
            <div class="input-field col s2">
                <input name="mov_location" value="" id="movieLocation" type="text" class="validate">
                <label for="movieLocation">Current Location</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s2">
                <input name="mov_poster" value="" id="moviePoster" type="text" class="validate">
                <img src="" />
                <a class="waves-effect waves-light btn"><i class="material-icons left">file_upload</i>Upload Poster File</a>
                <label for="moviePoster">Poster</label>
            </div>
            <div class="input-field col s10">
                <textarea name="mov_synopsis" id="movieSynopsis" class="materialize-textarea"></textarea>
                <label for="movieSynopsis">Synopsis</label>
            </div>
        </div>
        <div class="row">
            <div class="col s2"></div>
            <div class="input-field col s10">
                <textarea name="mov_note" id="movieNote" class="materialize-textarea"></textarea>
                <label for="movieNote">Note</label>
            </div>
        </div>
        <div class="row">
            <div class="col s11"></div>
            <input type="submit" class="col s1 waves-effect waves-light btn" value="Add" />
        </div>
    </form>
    <div class="row">
        <div class="col s11"></div>
        <input type="submit" class="col s1 waves-effect waves-light btn" value="OMDb" />
    </div>
</div>
<script lang="javascript" type="text/javascript">
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 500, // Creates a dropdown of 15 years to control year,
        //today: 'Today',
        min: new Date(1900,1,1),
        max: new Date('Y,m,d'),
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true // Close upon selecting a date,
    });
</script>
