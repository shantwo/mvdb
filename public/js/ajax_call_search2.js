//event listener
$("#search2").on("keyup", function(e){
    // e.preventDefault();
    $("#resultsSearch").html("");
    if( $("#search2").val() !== "" ){
        var search = $("#search2").val();
        $.ajax({
            type:'POST',
            url: "ajax/search.php",
            dataType : 'json',
            data: {'search':search}
        })
        .done(function(data) {
            typeArray = ['actors','country','date','directors','genre','language','location','medium','title'];
            for ( i = 0 ; i < typeArray.length ; i++){
                var toto = data[typeArray[i]].length;
                if (toto !== 0){
                    $("#resultsSearch").append("<ul class='collection with-header'><li class='collection-header blue-grey darken-2 white-text'><h4><i class='material-icons'>dvr</i> | "+typeArray[i].toUpperCase()+"</h4></li>");
                    for( j=0 ; j < toto ; j++ ){
                        display_info(data, j,typeArray[i]);
                    }
                }
            }
        })
        .fail(function() {
            alert("Bad news BRO, some gremlins ate your code!!");
        });
    }
})


//affichage d infos
function display_info(json, level, type){
    var location = json[type][level];
    info_type_test(type);
    if ( way !== 'mov_title'){
        $("#resultsSearch").append(
            "<li class='collection-item' style='list-style-type:none;margin-bottom:1em;height:25px;padding-left:5px'><strong>"+location['mov_title']+"</strong> - "+location[way]+"<img class='secondary-content' src='"+ location['mov_poster'] +"'></li>"
        );
    }
    else{
        $("#resultsSearch").append(
            "<li class='collection-item' style='list-style-type:none;margin-bottom:1em;height:25px;padding-left:5px'><div><strong>"+location['mov_title']+"</strong><img class='secondary-content' src='"+ location['mov_poster'] +"'></div></li>"
        );
    }
    $("#resultsSearch").append("</ul>");
}


//test du type
function info_type_test(info){
    var columnArray = ['mov_actors','cou_name','mov_release_date','mov_directors','gen_name','lan_name','mov_location','med_name','mov_title'];
    for ( k=0 ; k < typeArray.length ; k++){
        if ( info == typeArray[k]){
            way = columnArray[k];
        }
    }
}
