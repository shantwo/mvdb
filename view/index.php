<div class="container">
    <article class="center">
        <h2>MVDB &#124; Yet Another Movie Collection Manager</h2>
        <p>MVDB is a collection manager for all your movies, storing their location, poster, IMDBb references for all your pleasure</p>
    </article>
    <br />
    <form>
        <div class="input-field">
            <i class="left material-icons prefix">search</i>
            <input id="search2" type="search" required>
            <label for="search2">Search</label>
            <i class="blue-grey-text darken-2-text material-icons">close</i>
        </div>
    </form>
    <!-- Show latest entries -->
    <section id="latestEntries">
        <p id="latestEntriesTitle">Latest Entries:&nbsp;</p>
        <div class="row center-cols center-align">
            <?php $latestEntries = getLatestEntries(); ?>
            <?php foreach ($latestEntries as $currentArray) : ?>
                <div class="col m3">
                        <div  class="card horizontal">
                            <div class="card-image">
                                <img src="files/<?= $currentArray['mov_poster'] ?>">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <p><?= $currentArray['mov_title'] ?> (<?= $currentArray['mov_year'] ?>)</p>
                                </div>
                                <div class="card-action">
                                    <a href="#<?= $currentArray['mov_id'] ?>">View</a>
                                </div>
                            </div>
                        </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>
