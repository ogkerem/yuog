 <!-- Sidebar (offcanvas on sreens < 992px)-->
 <style>
     .brand_icon {
         width: 31px;
         height: 31px;
         border-radius: 50%;
         object-fit: cover;
     }
 </style>
 <aside class="col-lg-3 pe-lg-4 pe-xl-5 mt-n3">
     <div class="position-lg-sticky top-0">
         <div class="d-none d-lg-block" style="padding-top: 60px;"></div>
         <div class="offcanvas-lg offcanvas-start" id="sidebarAccount">
             <button class="btn-close position-absolute top-0 end-0 mt-3 me-3 d-lg-none" type="button" data-bs-dismiss="offcanvas" data-bs-target="#sidebarAccount"></button>
             <div class="offcanvas-body">
                 <div class="pb-2 pb-lg-0 mb-4 mb-lg-5">
                     <?php if ($uyeveri['resim'] == '') { ?>
                         <img class="d-block rounded-circle mb-2" src="uploads/<?php echo $genelbak['icon']; ?>" width="80" alt="<?php echo $uyeveri['bayi_adi']; ?>">
                     <?php } else { ?>
                         <img class="d-block rounded-circle mb-2" src="uploads/users/<?php echo $uyeveri['resim']; ?>" width="80" alt="<?php echo $uyeveri['bayi_adi']; ?>">

                     <?php } ?>
                     <h3 class="h5 mb-1"><?php echo $uyeveri['bayi_adi']; ?></h3>
                     <p class="fs-sm text-muted mb-0"><?php echo $uyeveri['yetkili_adi'] ?></p>
                 </div>
                 <nav class="nav flex-column pb-2 pb-lg-4 mb-3">
                     <h4 class="fs-xs fw-medium text-muted text-uppercase pb-1 mb-2">Hesap</h4>
                     <a class="nav-link fw-semibold py-2 px-0 <?php echo ($url == 'hesabim') ? 'active' : ''; ?>" href="hesabim">
                         <i class="ai-user-check fs-5 opacity-60 me-2"></i>Genel Bakış
                     </a>
                     <!-- <a class="nav-link fw-semibold py-2 px-0" href="account-settings.html">
                         <i class="ai-settings fs-5 opacity-60 me-2"></i>Settings
                     </a> -->
                     <a class="nav-link fw-semibold py-2 px-0 <?php echo ($url == 'bilgilerim') ? 'active' : ''; ?>" href="bilgilerim">
                         <i class="ai-settings fs-5 opacity-60 me-2"></i> Bilgierim
                     </a>
                     <a class="nav-link fw-semibold py-2 px-0 <?php echo ($url == 'servisler') ? 'active' : ''; ?>" href="servisler">
                         <i class="ai-compass fs-5 opacity-60 me-2"></i> Hizmetler Keşfet
                     </a>
                     <a class="nav-link fw-semibold py-2 px-0 <?php echo ($url == 'satin-alimlarim') ? 'active' : ''; ?>" href="satin-alimlarim">
                         <i class="ai-wallet fs-5 opacity-60 me-2"></i> Satın Alımlarım
                     </a>

                 </nav>
                 <nav class="nav flex-column pb-2 pb-lg-4 mb-1">
                     <h4 class="fs-xs fw-medium text-muted text-uppercase pb-1 mb-2">Hizmetler</h4>
                     <?php
                        $servisler = $mysqli->query("SELECT * FROM servis WHERE durum = 1 ORDER BY sira ASC");
                        foreach ($servisler as $servis) {
                        ?>
                         <a class="nav-link fw-semibold py-2 px-0" href="<?php echo seocuk($servis['seo']); ?>">
                             <img class="brand_icon" src="uploads/servis/<?php echo $servis['kresim']; ?>" alt="<?php echo $servis['baslik']; ?>">
                             <span class="ms-2"><?php echo $servis['baslik']; ?></span>
                         </a>
                     <?php } ?>


                 </nav>
                 <nav class="nav flex-column"><a class="nav-link fw-semibold py-2 px-0" href="cikis"><i class="ai-logout fs-5 opacity-60 me-2"></i>Çıkış</a></nav>
             </div>
         </div>
     </div>
 </aside>
 <!-- Page content-->
 <button class="d-lg-none btn btn-sm fs-sm btn-primary w-100 rounded-0 fixed-bottom" data-bs-toggle="offcanvas" data-bs-target="#sidebarAccount"><i class="ai-menu me-2"></i>Hesap Menüsü</button>