<?php
include dirname(dirname(__FILE__))."/inc/config.php";
include "../view/header.php";
$Array_list = List_all_movies($pdo);

include "../view/list.php";
include "../view/footer.php";
?>
