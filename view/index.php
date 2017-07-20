<div class="container">
    <article class="center">
        <h2>MVDB &#124; Yet Another Movie Collection Manager</h2>
        <p>MVDB is a collection manager for all your movies, storing their location, poster, imdb references for all your pleasures</p>
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
</div>
<!-- APPEL AJAX SEARCH FUNCTION -->
<script>
    $("#search2").on("keydown", function(e){
        e.preventDefault();
        var search = $("#search2").val();
        $.ajax({
            type:'POST',
            url: "ajax/search.php",
            data: {'search':search}
        })
        .done(function(data) {

        })
        .fail(function() {
            alert("Bad news BRO, some gremlins ate your code!!");
        });
    })
</script>
