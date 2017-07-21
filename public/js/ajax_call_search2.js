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
                    $("#resultsSearch").append("<h4>"+typeArray[i].toUpperCase()+"</h4>");
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
            "<section><img src='"+ location['mov_poster'] +"' height='50'><span><h5>"+location['mov_title']+"</h5><p>"+location[way]+"</p></span><br>"
        );
    }
    else{
        $("#resultsSearch").append(
            "<section><img src='"+ location['mov_poster'] +"' height='50'><span><h5>"+location['mov_title']+"</h5></span><br>"
        );
    }
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
