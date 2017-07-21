<div class="container">
    <?php foreach($Array_list as $value):?>
        <div class="card horizontal">
            <div class="card-image">
                <img src="../public/files/<?= $value['mov_poster'] ?>" height="250">
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <h4 style="margin-bottom:2px"><?= $value['mov_title'] ?></h4>
                    <p style="font-style:italic"><?= $value['mov_actors'] ?></p>
                    <blockquote class="blue-grey-text darken-2-text" style="margin-bottom:2px"><?= $value['mov_release_date'] ?></blockquote>
                    <p><?= $value['mov_synopsis'] ?></p>
                </div>
                <div class="card-action">
                    <a href="#modal1?id=<?= $value['mov_id'] ?>">SEE DETAILS</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>

<script lang="javascript" type="text/javascript" src="js/list_modal_init.js">
