<?php

defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

require_once('Classes/PHPExcel.php');


?>
<?php

if ($_POST) {

    $name               = $_FILES['excel']['name'];
    $kaynak                = $_FILES['excel']['tmp_name'];
    $rhedef                = "../excel/";
    $excelsonad         = rand(0, 999) . '-' . yeniurl(res_adi($name)) . res_uzanti($name);
    $excelyukle         = move_uploaded_file($kaynak, $rhedef . "/" . $excelsonad);
    $excelyol           = $rhedef . $excelsonad;
    $excel = new PHPExcel();
    $excel = PHPExcel_IOFactory::load($excelyol);
    $i = 1;
    while ($excel->getActiveSheet()->getCell('A' . $i)->getValue() != "") {

        $kodu             = trim($excel->getActiveSheet()->getCell('A' . $i)->getValue());

        $guncelle = $mysqli->query("UPDATE urun SET durum = 0 WHERE kodu = '$kodu'");
        echo $kodu . '<br>';
        $i++;
    }
} else {
?>

    <form action="#" method="POST" enctype="multipart/form-data">
        <input type="file" name="excel">
        <input type="submit" name="submit">
    </form>

<?php } ?>