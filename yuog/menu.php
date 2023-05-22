 <?php

    defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');


    ?>

 <div class="side-content-wrap">
     <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
         <ul class="navigation-left">
             <!--  <li class="nav-item "  >
                <a class="nav-item-hold" href="index.php">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Ana Ekran</span>
                </a>
                <div class="triangle"></div>
            </li> -->


             <li class="nav-item">
                 <a class="nav-item-hold" href="?sy=servis">
                     <i class="nav-icon i-Suitcase"></i>
                     <span class="nav-text">Servisler</span>
                 </a>
                 <div class="triangle"></div>
             </li>

             <li class="nav-item" data-item="crm">
                 <a class="nav-item-hold" href="#">
                     <i class="nav-icon mb-3 bi bi-android2"></i>
                     <span class="nav-text">CRM</span>
                 </a>
                 <div class="triangle"></div>
             </li>



             <li class="nav-item " data-item="icerik">
                 <a class="nav-item-hold" href="?sy=icerik">
                     <i class="nav-icon i-File-Clipboard-File--Text"></i>
                     <span class="nav-text">İçerikler</span>
                 </a>
                 <div class="triangle"></div>
             </li>



             <li class="nav-item">
                 <a class="nav-item-hold" href="?sy=diller">
                     <i class="fa fa-language" style="font-size:40px;"></i>
                     <span class="nav-text">Diller</span>
                 </a>
                 <div class="triangle"></div>
             </li>

             <!-- 
		  <li class="nav-item" data-item="uikits">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Library"></i>
                    <span class="nav-text">Rezervasyonlar</span>
                </a>
                <div class="triangle"></div>
            </li>  
            <li class="nav-item" data-item="acenta">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Computer-Secure"></i>
                    <span class="nav-text">Acentalar</span>
                </a>
                <div class="triangle"></div>
            </li>  
			 
			 
			   <li class="nav-item"  >
                <a class="nav-item-hold" href="?sy=kupon">
                    <i class="nav-icon i-Double-Tap"></i>
                    <span class="nav-text">Kuponlar</span>
                </a>
                <div class="triangle"></div>
            </li>  
			-->
             <li class="nav-item " data-item="gorsel">
                 <a class="nav-item-hold">
                     <i class="nav-icon fa fa-image"></i>
                     <span class="nav-text">Görseller</span>
                 </a>
                 <div class="triangle"></div>
             </li>

             <li class="nav-item " data-item="anasayfa">
                 <a class="nav-item-hold" href="?sy=anasayfa">
                     <i class="nav-icon fa fa-home"></i>
                     <span class="nav-text">Site Ana Sayfa</span>
                 </a>
                 <div class="triangle"></div>
             </li>




             <!--	 <li class="nav-item ">
                <a class="nav-item-hold" href="?sy=admin">
                    <i class="nav-icon i-Administrator"></i>
                    <span class="nav-text">Adminler</span>
                </a>
                <div class="triangle"></div> 
            </li> 
			
		<li class="nav-item " data-item="sistem">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Suitcase"></i>
                    <span class="nav-text">Sistem</span>
                </a>
                <div class="triangle"></div>
            </li>
			-->

             <li class="nav-item " data-item="widgets">
                 <a class="nav-item-hold" href="#">
                     <i class="nav-icon i-Windows-2"></i>
                     <span class="nav-text">Ayarlar</span>
                 </a>
                 <div class="triangle"></div>
             </li>



         </ul>
     </div>

     <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">


         <ul class="childNav" data-parent="gorsel">
             <li class="nav-item">
                 <a class="" href="?sy=banner">
                     <i class="nav-icon i-Width-Window"></i>
                     <span class="item-name">Banner</span>
                 </a>
             </li>
             <li class="nav-item ">
                 <a class="nav-item-hold" href="?sy=tasarim">
                     <i class="nav-icon i-File-Horizontal-Text"></i>
                     <span class="item-name">Arkaplan Resimleri</span>
                 </a>

             </li>
         </ul>


         <ul class="childNav" data-parent="crm">

             <li class="nav-item">
                 <a class="" href="?sy=siparis">
                     <i class="nav-icon i-Receipt-4"></i>
                     <span class="item-name">Siparişler
                         <?php
                            @$veri = $mysqli->query("SELECT * FROM siparis WHERE okundu='0' ORDER BY id ASC")->num_rows;
                            if ($veri) {
                                echo '(' . $veri . ')';
                            }
                            ?>
                     </span>
                 </a>
             </li>

             <!-- <li class="nav-item">
                 <a class="" href="?sy=sepet">
                     <i class="nav-icon i-Receipt-4"></i>
                     <span class="item-name">Sepet

                     </span>
                 </a>
             </li> -->

             <li class="nav-item">
                 <a class="nav-item-hold" href="?sy=destek" target="_blank">
                     <i class="nav-icon i-Safe-Box1"></i>
                     <span class="nav-text">Destek</span>
                 </a>
                 <div class="triangle"></div>
             </li>

             <li class="nav-item">
                 <a class="" href="?sy=bayiler">
                     <i class="nav-icon i-Receipt-4"></i>
                     <span class="item-name">Müşteriler
                         <?php
                            @$veri = $mysqli->query("SELECT * FROM uyeler WHERE durum = '' ORDER BY id ASC")->num_rows;
                            if ($veri) {
                                echo '(' . $veri . ')';
                            }
                            ?>
                     </span>
                 </a>
             </li>

             <li class="nav-item">
                 <a class="" href="?sy=kasa">
                     <i class="nav-icon i-Receipt-4"></i>
                     <span class="item-name">Muhasebe

                     </span>
                 </a>
             </li>

             <li class="nav-item">
                 <a class="" href="?sy=parabirimi">
                     <i class="nav-icon i-Money-2"></i>
                     <span class="item-name">Para Birimleri
                     </span>
                 </a>
             </li>

             <li class="nav-item">
                 <a class="" href="?sy=kdv">
                     <i class="nav-icon i-Money-2"></i>
                     <span class="item-name">KDV
                     </span>
                 </a>
             </li>


             <li class="nav-item">
                 <a class="" href="?sy=banka">
                     <i class="nav-icon i-Bank"></i>
                     <span class="item-name">Banka Bilgileri
                     </span>
                 </a>
             </li>



             <li class="nav-item">
                 <a class="" href="?sy=sayar">
                     <i class="nav-icon i-Receipt-4"></i>
                     <span class="item-name">CRM Ayarlar
                     </span>
                 </a>
             </li>


         </ul>

         <ul class="childNav" data-parent="icerik">


             <!-- <li class="nav-item">
                 <a class="" href="?sy=urun">
                     <i class="nav-icon i-Receipt-4"></i>
                     <span class="item-name"> Ürünler

                     </span>
                 </a>
             </li> -->


             <?php

                $menubak = $mysqli->query("select * from sistem  where durum='on' order by sira asc ");
                while ($menuyaz = $menubak->fetch_array()) {
                    echo ' <li class="nav-item">
                <a class="" href="?sy=sahap&sistem=' . $menuyaz['id'] . '">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">' . $menuyaz['menu'] . '</span>
                </a>
            </li>';
                }

                ?>




         </ul>
         <ul class="childNav" data-parent="widgets">

             <li class="nav-item">
                 <a class="" href="?sy=genel">
                     <i class="nav-icon i-Receipt-4"></i>
                     <span class="item-name">Genel Ayarlar</span>
                 </a>
             </li>

             <li class="nav-item">
                 <a class="" href="?sy=contact">
                     <i class="nav-icon fa fa-map-pin"></i>
                     <span class="item-name">İletişim Bilgileri</span>
                 </a>
             </li>

             <li class="nav-item">
                 <a class="" href="?sy=iletisim">
                     <i class="nav-icon fa fa-map-pin"></i>
                     <span class="item-name">İletişimler(<?php
                                                            $iletisimbak = $mysqli->query("SELECT * FROM iletisim WHERE durum=0")->num_rows;
                                                            echo $iletisimbak; ?>)</span>
                 </a>
             </li>

             <li class="nav-item">
                 <a class="" href="?sy=sube">
                     <i class="nav-icon fa fa-map-pin"></i>
                     <span class="item-name">Şubeler</span>
                 </a>
             </li>

             <li class="nav-item">
                 <a class="" href="?sy=social">
                     <i class="nav-icon i-Receipt-4"></i>
                     <span class="item-name">Sosyal Medya</span>
                 </a>
             </li>

             <!--	<li class="nav-item"> 
                <a class="" href="?sy=parabirimi">
                    <i class="nav-icon i-Money-2"></i>
                    <span class="item-name">Para Birimleri</span>
                </a>
            </li> -->

             <li class="nav-item">
                 <a class="" href="?sy=kvkk">
                     <i class="nav-icon i-Receipt-4"></i>
                     <span class="item-name"> KVKK </span>
                 </a>
             </li>

             <li class="nav-item">
                 <a class="" href="?sy=popup">
                     <i class="nav-icon i-Receipt-4"></i>
                     <span class="item-name"> Popup </span>
                 </a>
             </li>

             <li class="nav-item">
                 <a class="" href="?sy=analytic">
                     <i class="nav-icon fa fa fa-sitemap"></i>
                     <span class="item-name">Analytic </span>
                 </a>
             </li>

             <li class="nav-item">
                 <a class="" href="?sy=xml">
                     <i class="nav-icon fa fa-sitemap"></i>
                     <span class="item-name">XML </span>
                 </a>
             </li>


             <li class="nav-item">
                 <a class="" href="?sy=admin">
                     <i class="nav-icon i-Administrator"></i>
                     <span class="item-name">Adminler </span>
                 </a>
             </li>



             <li class="nav-item">
                 <a class="" href="?sy=sozlesme">
                     <i class="nav-icon i-Receipt-4"></i>
                     <span class="item-name">Sözleşmeler </span>
                 </a>
             </li>

             <!--       <li class="nav-item"> 
                <a class="" href="?sy=ssozlesme">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">Satış Sözleşmesi </span>
                </a>
            </li> 
   

            <li class="nav-item"> 
                <a class="" href="?sy=banka">
                    <i class="nav-icon i-Receipt-4"></i>
                    <span class="item-name">Banka Bilgileri </span>
                </a>
            </li>  
-->


         </ul>

         <ul class="childNav" data-parent="sistem">
             <li class="nav-item">
                 <a class="" href="?sy=musteriler">
                     <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                     <span class="item-name">Müşteriler</span>
                 </a>
             </li>



             <li class="nav-item">
                 <a class="" href="?sy=musteriler">
                     <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                     <span class="item-name">Sepet</span>
                 </a>
             </li>

             <!-- <li class="nav-item dropdown-sidemenu">
                 <a>
                     <i class="nav-icon i-File-Clipboard-Text--Image"></i>
                     <span class="item-name">Siparişler</span>
                     <i class="dd-arrow i-Arrow-Down"></i>
                 </a>
                 <ul class="submenu">
                     <li><a class="" href="?sy=siparisler">Siparişler Genel</a></li>
                     <li><a class="" href="?sy=hazir">Hazır Siteler</a></li>
                     <li><a class="" href="?sy=urunler">Ürünler</a></li>

                     <li><a class="" href="?sy=hosting">Hosting</a></li>
                     <li><a class="" href="?sy=sunucu">Sunucu</a></li>


                 </ul>
             </li> -->





         </ul>

         <ul class="childNav" data-parent="acenta">
             <li class="nav-item">
                 <a class="" href="?sy=acenta">
                     <i class="nav-icon i-Find-User"></i>
                     <span class="item-name">Acentalar</span>
                 </a>
             </li>

         </ul>

         <ul class="childNav" data-parent="anasayfa">


             <li class="nav-item">
                 <a href="?sy=anakonum">
                     <i class="nav-icon i-Shop-2"></i>
                     <span class="item-name">Ana Sayfa Genel</span>
                 </a>
             </li>



             <?php
                $aabak = $mysqli->query("select * from anasayfa where durum='on' order by sira asc ");
                while ($aayaz = $aabak->fetch_array()) {

                    echo '<li class="nav-item">
                <a href="?sy=anaicerik&id=' . $aayaz['id'] . '">
                    <i class="nav-icon i-Width-Window"></i>
                    <span class="item-name">' . $aayaz['baslik'] . '</span>
                </a>
            </li> ';
                }

                ?>

         </ul>

         <ul class="childNav" data-parent="others">
             <li class="nav-item">
                 <a href="others/notFound.html">
                     <i class="nav-icon i-Error-404-Window"></i>
                     <span class="item-name">Not Found</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="" href="others/pricing-table.html">
                     <i class="nav-icon i-Billing"></i>
                     <span class="item-name">Pricing Table <span class="ml-2 badge badge-pill badge-danger">New</span></span>
                 </a>
             </li>

             <li class="nav-item">
                 <a class="" href="others/search-result.html">
                     <i class="nav-icon i-File-Search"></i>
                     <span class="item-name">Search Result <span class="badge badge-pill badge-danger">New</span></span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="" href="others/user-profile.html">
                     <i class="nav-icon i-Male"></i>
                     <span class="item-name">User Profile</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="" href="others/faq.html" class="open">
                     <i class="nav-icon i-File-Horizontal"></i>
                     <span class="item-name">faq</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="" href="others/starter.html" class="open">
                     <i class="nav-icon i-File-Horizontal"></i>
                     <span class="item-name">Blank Page</span>
                 </a>
             </li>
         </ul>
     </div>
     <div class="sidebar-overlay"></div>
 </div>