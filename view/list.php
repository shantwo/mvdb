<script lang="javascript" type="text/javascript" src="js/list_modal_init.js"></script>
<div class="container">
    <?php foreach($Array_list as $value):?>
        <div class="card horizontal">
            <div class="card-image id<?= $value['mov_id']?>">
                <script>
                poster = "<?= $value['mov_poster'] ?>";
                if ( poster == ""){
                    $(".id<?= $value['mov_id']?>").append('<img src="../public/files/blank.jpg" height="300" onerror="imgError()">')
                }
                else{
                    $(".id<?= $value['mov_id']?>").append('<img src="../public/files/<?= $value['mov_poster'] ?>" height="300" onerror="imgError()">')
                }
                </script>
                <!-- <img src="../public/files/<?= $value['mov_poster'] ?>" height="300" onerror="imgError()"> -->
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <h4 style="margin-bottom:2px"><?= $value['mov_title'] ?></h4>
                    <p style="font-style:italic"><?= $value['mov_actors'] ?></p>
                    <blockquote class="blue-grey-text darken-2-text" style="margin-bottom:2px"><?= $value['mov_release_date'] ?></blockquote>
                    <p><?= $value['mov_synopsis'] ?></p>
                </div>
                <div class="card-action">
                    <a href="#modal1"  class="view btn modal-trigger" name="<?= $value['mov_id']?>">SEE DETAILS</a>
                    <!-- <a href="#modal1" id="edit" class="btn modal-trigger" name="<?= $value['mov_id']?>">EDIT DETAILS</a> -->
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div

<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">

    </div>
    <div class="modal-footer">
    </div>
</div>

<script type="text/javascript">
    $(".view").on("click", function(){
        $('#modal1').modal('open');
        console.log(this.name);
        id = this.name;
        modalcontent(id);
    });

    function modalcontent(valeurId){
        $(".modal-content").html("");
        console.log(valeurId);
        $.ajax({
            type:'POST',
            url: "ajax/read.php",
            dataType : 'json',
            data: {'id':valeurId}
        })
        .done(function(data) {
            console.log('ok');
            console.log(data);
            $(".modal-content").append("");
            $(".modal-content").append("<img src='files/"+data[0]['mov_poster']+"' height='300' style='float:right' /><h4>"+data[0]['mov_title']+"</h4><br />");
            $(".modal-content").append("<hr />");
            $(".modal-content").append("<strong>TITLE : </strong>"+data[0]['mov_title']+"<br />");
            $(".modal-content").append("<strong>ACTORS : </strong>"+data[0]['mov_actors']+"<br />");
            $(".modal-content").append("<strong>DIRECTORS : </strong>"+data[0]['mov_directors']+"<br />");
            $(".modal-content").append("<strong>COUNTRY : </strong>"+data[0]['cou_name']+"<br />");
            $(".modal-content").append("<strong>LANGUAGE : </strong>"+data[0]['lan_name']+"<br />");
            $(".modal-content").append("<strong>MEDIUM : </strong>"+data[0]['med_name']+"<br />");
            $(".modal-content").append("<strong>IMDB RATING : </strong>"+data[0]['mov_imdb_rating']+"<br />");
            $(".modal-content").append("<strong>LOCATION : </strong>"+data[0]['mov_location']+"<br />");
            $(".modal-content").append("<strong>NOTE : </strong>"+data[0]['mov_note']+"<br />");
            $(".modal-content").append("<strong>YEAR : </strong>"+data[0]['mov_year']+"<br />");
            $(".modal-content").append("<strong>RUN TIME : </strong>"+data[0]['mov_run_time']+"<br />");
            $(".modal-content").append("<strong>SYNOPSIS : </strong>"+data[0]['mov_synopsis']+"<br />");
            $(".modal-footer").html("");
            $(".modal-footer").append('<a href="#!" id="edit" class="modal-action waves-effect waves-green btn-flat" name="'+data[0]['mov_id']+'">EDIT</a>');
            $(".modal-footer").append('<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>');
        })
        .fail(function() {
            alert("Bad news BRO, some gremlins ate your code!!");
        });

    }

</script>
