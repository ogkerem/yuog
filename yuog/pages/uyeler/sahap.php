 <?php

    defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');


    ?>


 <div class="main-content">

     <div class="breadcrumb">
         <h1>Bayiler</h1>
         <ul>
             <li><a href="index.php">Ana Sayfa</a></li>
             <li> İçerikler </li>

         </ul>
     </div>
     <div class="separator-breadcrumb border-top"></div>

     <?php @$islem = $_GET['islem'];
        if ($islem == "basarili") {

            echo '	<div class="alert alert-card alert-success" role="alert">
			<strong class="text-capitalize">Başarılı !</strong> İşleminiz başarıyla gerçekleştirilmiştir.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div> ';
        }

        ?>


     <section class="contact-list">
         <div class="row">
             <div class="col-md-12 mb-4">
                 <div class="card text-left">
                     <div class="card-header text-right bg-transparent">
             


                     </div>



                     <div class="card-body">

                         <div class="table-responsive">
                             <table id="ul-contact-list" class="display table " style="width:100%">
                                 <thead>
                                     <tr>

                                         <th>ID</th>
                                         <th>Bayi Adı</th>
                                         <th>Mail Adresi</th>
                                         <th>Durum</th>
                                      
                                         <th>İşlemler</th>

                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        $verilerigetir = $mysqli->query("SELECT * FROM uyeler ORDER BY id DESC");
                                        while ($veri = $verilerigetir->fetch_assoc()) {

                                        ?>
                                         <tr>
                                             <td><?php echo $veri['id']; ?></td>
                                             <td>
                                                 <?php
                                                        echo $veri['bayi_adi'];
                                                    ?>
                                             </td>
                                             
                                             <td><?php echo $veri['mail']; ?></td>
                                             <td>
                                                 <?php
                                                    if ($veri['durum'] == 1) {
                                                        echo '<div class="badge badge-success m-2 p-2">Aktif</div>';
                                                    } else {
                                                        echo '<div class="badge badge-danger m-2 p-2">Pasif</div>';
                                                    }
                                                    ?>
                                             </td>

                                        
                                             <td>
                                                 <a href="?sy=uyeduzenle&id=<?php echo $veri['id']; ?>" class="ul-link-action text-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                                                     <i class="i-Edit"></i>
                                                 </a>
                                                 <a href="?sy=uyesil&id=<?php echo $veri['id']; ?>" class="ul-link-action text-danger mr-1" data-toggle="tooltip" data-placement="top" title="Sil" onclick=" if ( !confirm(\'Kaydi silmek istediğinizden emin misiniz?\') ) return false;">
                                                     <i class="i-Eraser-2"></i>
                                                 </a>
                                             </td>

                                         </tr>
                                     <?php } ?>


                                 </tbody>

                             </table>
                         </div>

                     </div>
                 </div>
             </div>
         </div>
     </section>
 </div>

 <script>
     $('#ul-contact-list').DataTable();
 </script>