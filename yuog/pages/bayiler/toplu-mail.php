<?php

defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

?>

<div class="main-content">

    <div class="breadcrumb">
        <h1><a href="?sy=bayiler">Müşteriler | </a> Mail Gönder </h1>
        <ul>
            <li><a href="/YUOG">Ana Sayfa</a></li>
            <li>Toplu Mail</li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">

                    <?php
                    if ($_POST) {

                        $icerik = $_POST['icerik'];
                        $konu   = $_POST['konu'];
                        $baslik = $_POST['baslik'];

                        $bayiler = $mysqli->query("SELECT * FROM uyeler WHERE durum = 'on' ORDER BY id ASC");
                        foreach ($bayiler as $bayi) {
                            mailgonder($bayi['mail'], $icerik, $konu, $baslik);
                        }

                        // mailgonder('ogkeremw@gmail.com', $icerik, $konu, $baslik);
                    } else {
                    ?>

                        <form action="" method="POST">

                            <div class="form-group row">
                                <label for="konu" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Konu * </label>
                                <div class="col-sm-6">
                                    <input type="text" name="konu" class="form-control" id="konu" placeholder="Konu" value="" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="baslik" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Başlık * </label>
                                <div class="col-sm-6">
                                    <input type="text" name="baslik" class="form-control" id="baslik" placeholder="Başlık" value="" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="faks" class="col-sm-2 col-form-label">Mail İçeriği </label>
                                <div class="col-sm-10">
                                    <textarea name="icerik" class="ckeditor" id="icerik" cols="70" rows="10"></textarea>
                                </div>
                            </div>




                            <div class="form-group row">
                                <label for="sira" class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary ul-btn__text">Maili Gönder</button>

                                </div>
                            </div>

                        </form>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>