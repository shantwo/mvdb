$(document).ready(function(){
    $('select').material_select();
    $('.modal').modal({
    dismissible: false,
    ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
        $("#edit").on("click",function(event){
            event.preventDefault();
            id=this.name;
            modaledit(id);
        });

        function modaledit(valeurId){
            $(".modal-content").html("");
            console.log(valeurId);
            $.ajax({
                type:'POST',
                url: "ajax/read.php",
                dataType : 'json',
                data: {'id':valeurId}
            })
            .done(function(data) {
                film = data;
                language = film[0]['lan_name'];
                $('select').material_select('destroy');
                $(".modal-content").append("<label>TITRE</label>");
                $(".modal-content").append("<input name='title' type='text' value='"+film[0]['mov_title']+"'/>");
                $(".modal-content").append("<label>ACTORS</label>");
                $(".modal-content").append("<input name='actors' type='text' value='"+film[0]['mov_actors']+"'/>");
                $(".modal-content").append("<label>DIRECTORS</label>");
                $(".modal-content").append("<input name='directors' type='text' value='"+film[0]['mov_directors']+"'/>");
                $(".modal-content").append("<label>LANGUAGE</label>");
                $(".modal-content").append("<select name='language' id='language'>");
                language_list(language);
                $(".modal-content").append("</select>");
                $(".modal-content").append("<br />");
                $(".modal-content").append("<label>MEDIUM</label>");
                $(".modal-content").append("<input name='medium' type='text' value='"+film[0]['med_name']+"'/>");
                $(".modal-content").append("<label>LOCATION</label>");
                $(".modal-content").append("<input name='location' type='text' value='"+film[0]['mov_location']+"'/>");
                $(".modal-content").append("<label>YEAR</label>");
                $(".modal-content").append("<input name='year' type='text' value='"+film[0]['mov_year']+"'/>");
                $(".modal-content").append("<label>RUN TIME</label>");
                $(".modal-content").append("<input name='run_time' type='text' value='"+film[0]['mov_run_time']+"'/>");
                $(".modal-content").append("<label>POSTER</label>");
                $(".modal-content").append("<input name='poster' type='text' value='"+film[0]['mov_poster']+"'/>");
                $(".modal-content").append("<label>SYNOPSIS</label>");
                $(".modal-content").append("<textarea name='synopsis' class='materialize-textarea'>"+film[0]['mov_synopsis']+"</textarea>");
                $(".modal-content").append("<label>NOTE</label>");
                $(".modal-content").append("<textarea name='note' class='materialize-textarea'>"+film[0]['mov_note']+"</textarea>");
                $(".modal-footer").html("");
                $(".modal-footer").append('<a href="#!" id="save" class="waves-effect waves-green btn-flat" name="'+data[0]['mov_id']+'">SAVE</a>');
                $(".modal-footer").append('<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">CLOSE</a>');

                $("#save").on("click",function(event){
                    console.log("text");
                    event.preventDefault();
                    id=this.name;
                    m_title = $('[name="title"]').val();
                    m_actors = $('[name="actors"]').val();
                    m_directors = $('[name="directors"]').val();
                    m_language = $('[name="language"]').val();
                    m_medium = $('[name="medium"]').val();
                    m_location = $('[name="location"]').val();
                    m_year = $('[name="year"]').val();
                    m_run_time = $('[name="run_time"]').val();
                    m_poster = $('[name="poster"]').val();
                    m_synopsis = $('[name="synopsis"]').val();
                    m_note = $('[name="note"]').val();
                    savemovie(id, m_title, m_actors, m_directors, m_language, m_medium, m_location, m_year, m_run_time, m_poster, m_synopsis, m_note);
                });
            })
            .fail(function() {
                alert("Bad news BRO, some gremlins ate your code basterd!!");
            });
        }

        function language_list(language){
            $.ajax({
                type:'POST',
                url: "ajax/language.php",
                dataType : 'json',
            })
            .done(function(data) {
                $.each(data,function(key, value){
                    if(value['lan_name'] == language){
                        $("#language").append("<option value='"+ value['lan_name'] +"' selected>"+ value['lan_name'] +"</option>");
                    }
                    else{
                        $("#language").append("<option value='"+ value['lan_name'] +"'>"+ value['lan_name'] +"</option>");
                    }
                });
                $('select').material_select();
            });
        }

        function savemovie(id, m_title, m_actors, m_directors, m_language, m_medium, m_location, m_year, m_run_time, m_poster, m_synopsis, m_note){
            $.ajax({
                type:'POST',
                url: "ajax/edit.php",
                data: {'id':id,
                        'title':m_title,
                        'actors':m_actors,
                        'directors':m_directors,
                        'language' : m_language,
                        'medium' : m_medium,
                        'location' : m_location,
                        'year' : m_year,
                        'run_time': m_run_time,
                        'poster' : m_poster,
                        'synopsis': m_synopsis,
                        'note' : m_note
                }
            })
            .done(function() {
                alert("Modifications prises en compte");
                $('#modal1').modal('close');    
            })
            .fail(function() {
                alert("OUIN OUIN OUIN OUINNNNNNN AJAX IS LOST IN THE SPACETIME PARADOX");
            })
        }


    }
  });
});
