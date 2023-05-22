<?php
require_once("sections/header.php");
require_once("sections/menu2.php");
if ($_SESSION['id']) {
    $uyeid = $_SESSION['id'];
    $uyeveri = $mysqli->query("SELECT * FROM uyeler WHERE id ='$uyeid' ")->fetch_assoc();
?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>





    </style>
    <div class="container">

        <div class="row d-flex justify-content-around" style="padding-top: 200px;">
            <?php require_once("sections/hesap-header.php"); ?>

            <?php
            $destekSor = $mysqli->query("SELECT * FROM destek WHERE uyeID = $uyeid ORDER BY id DESC");
            ?>
            <div class="col-md-8 pt-4">
                <div class="d-flex justify-content-end py-3">
                    <a href="helpme">
                        <button type="button" class="btn btn-outline-dark">Destek Talebi Oluştur <i class="fas fa-plus"></i></button>
                    </a>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Konu</th>
                            <th scope="col">Tarih</th>
                            <th scope="col">Durum</th>
                            <th scope="col" class=" text-center">Detaylar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($destekSor as $destek) {
                            $katID = $destek['katID'];
                            $destekkat = $mysqli->query("SELECT * FROM destekkat WHERE id = $katID")->fetch_assoc();
                        ?>
                            <tr>
                                <th scope="row">#<?php echo $destek['destekno'] ?></th>
                                <td><?php echo $destekkat['baslik']; ?></td>
                                <td><?php echo substr($destek['konu'], 0, 30); ?></td>
                                <td><?php echo substr($destek['tarih'], 0, 10); ?></td>
                                <td><?php echo ($destek['durum'] == 0) ? 'Devam Ediyor' : 'Çözüldü'; ?></td>
                                <td class="text-center"> <a href="destekdetay?detay=<?php echo $destek['id']; ?>"><i class="fas fa-eye"></i></a></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
<?php


} else {
    header("Location: /uye-giris");
} ?>
<?php require_once("sections/footer.php"); ?>