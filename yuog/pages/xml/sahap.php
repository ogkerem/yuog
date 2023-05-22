	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	
	 
	?>
	
	
<div class="main-content">
                    
<div class="breadcrumb">
  
	 <h1>  XML   </a>  </h1>
    <ul>
        <li><a href="index.php">Ana Sayfa</a></li>
   
        <li> İçerikler </li>
		 
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>

 <?php $islem = @$_GET['islem']; 
			if($islem=="basarili"){
				
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
	<!-- <button type="button" data-toggle="modal" data-tkurumsalt=".bd-example-modal-lg" class="btn btn-primary btn-md m-1"><i class="i-Add-User text-white mr-2"></i> İçerik Ekle </button> -->
	
	<a href="?sy=xmlcalistir"><button type="button" class="btn btn-primary btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-refresh" ></i> </span>
		<span class="ul-btn__text">XML Çalıştır</span>
	</button>
	</a>
	
	<!-- <a href="?sy=<?php echo $kat; ?>"><button type="button" class="btn btn-warning btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-asterisk" ></i> </span>
		<span class="ul-btn__text">Kategoriler</span>
	</button>
	</a> 
	
	<a href="?sy=turtarih"><button type="button" class="btn btn-info btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-calendar" ></i> </span>
		<span class="ul-btn__text">Tarihler</span>
	</button>
	</a>
	 
	<a href="?sy=bilgi&konu=<?php echo $konu;?>"><button type="button" class="btn btn-light btn-icon m-1">
	 <span class="ul-btn__icon"> <i class="fa fa-share" ></i> </span>
		<span class="ul-btn__text"> Genel Açıklama </span>
	</button>
	</a> -->
										
</div>
                      
                       

 <div class="card-body">
                            
 
 <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="card-title mb-4">XML URL</div>

              <a href="https://www.<?php echo $genelbak['web']; ?>/sitemap.xml" target="_blank"> https://www.<?php echo $genelbak['web']; ?>/sitemap.xml</a>

                        </div>
                    </div>
                </div>
         </div>




		</div>
	</div>
</div>
    </div>
</section> 
  </div>
				
 
