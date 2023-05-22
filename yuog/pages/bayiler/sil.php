<?php

defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');

$id     = $_GET['id'];


                    $id= $_GET['id'];

                    $sil = $mysqli->query("delete from uyeler where id='$id'");

                    if ($sil) {

                        header("Location:?sy=bayiler&konu=" . 'bayiler' . "&islem=basarili");
                    } else {
                        echo 'Hata! İçerik silinemedi ';
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>