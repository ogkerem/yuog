
    
<?php
require_once("sections/head.php");
require_once("sections/header.php");
?>


<?php
if (($sayfa != "") && ($konu == "")) {


    if (($sayfa == "hakkimzida") || ($sayfa == "aboutus")) {
        include("pages/hakkimizda.php");
    } else {
        include("yok.php");
    }
} else {


    switch ($konu) {


        case $konu:
            include("pages/" . $konu . ".php");

            break;

        default:
            include("yok.php");
            break;
    }
}



?>    


<?php require_once("sections/footer.php"); ?> 