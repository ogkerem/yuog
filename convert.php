<?php
require_once 'sections/head.php';
require_once 'sections/header.php';
?>



<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadedFileNames = $_FILES['dosya']['name'];
    $uploadedFileSources = $_FILES['dosya']['tmp_name'];
    // $uploadedFiles = $_FILES['dosya'];
    // print_r($uploadedFileNames);
    // print_r($uploadedFileSource);



    $uploadedFileCount = count($uploadedFileNames);
    for ($i = 0; $i < $uploadedFileCount; $i++) {
        $uploadedFile = $uploadedFileNames[$i];
        $uploadedTMP = $uploadedFileSources[$i];

        $targetDirectory = "uploads/convert/";
        $targetFileName = $uploadedFile;
        $targetFile = $targetDirectory . $targetFileName;

        if (move_uploaded_file($uploadedTMP, $targetFile)) {
            $webpFile = $targetDirectory . pathinfo($targetFileName, PATHINFO_FILENAME) . '.webp';
            $imagick = new Imagick($targetFile);
            $imagick->setImageFormat('webp');
            $imagick->writeImage($webpFile);

            $imagePath = $webpFile;
            $resmiKaydet = $mysqli->query("INSERT INTO image_convert SET image_path = '$imagePath', musteriID = $uyeid, tarih = now()");
            if ($resmiKaydet) {
                echo "Görsel yolunu veritabanına başarıyla kaydettiniz.";
            } else {
                echo "Veritabanına kaydetme hatası: " . $mysqli->error();
            }
        } else {
            echo "Dosya yükleme hatası.";
        }
    }
}
?>
<section style="padding: 100px 0px">
    <div class="container-fluid">
        <form action="" method="POST" enctype="multipart/form-data">
            <button class="downloadAll" type="button">Hepsini indir</button>
            <div class="layout">
                <h1>Görseli webp formatına dönüştürün</h1>

                <div>
                    <input class="file_load" type="file" name="dosya[]" multiple accept="image/*">
                </div>

                <div id="previews"></div>
                <div class="dropTarget"></div>
                <button type="submit">Kaydet</button>
            </div>
        </form>
    </div>
</section>

<script src="assets/js/convert.js"></script>

<?php
require_once 'sections/footer.php';
?>