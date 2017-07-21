<script lang="javascript" type="text/javascript" src="js/list_modal_init.js"></script>
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
                    <a href="#modal1" class="btn modal-trigger" name="<?= $value['mov_id']?>">SEE DETAILS</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">

    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
    </div>
</div>

<script type="text/javascript">
    $(".btn").on("click", function(){
        var id = this.name;
        modalcontent(id);
    });

    function modalcontent(valeurId){
        $(".modal-content").html("");
            $.ajax({
                type:'POST',
                url: "ajax/read.php",
                dataType : 'json',
                data: {'id':id}
            })
            .done(function(data) {
                print_r(data);
            })
            .fail(function() {
                alert("Bad news BRO, some gremlins ate your code!!");
            });
        }
    }
</script>
