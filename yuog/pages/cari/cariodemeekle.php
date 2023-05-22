<?php 
	 
     defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');

    $carihizmet     = $_GET['carihizmet'];
    $hizmetbul      = $mysqli->query("select * from carihizmet where id='$carihizmet' ")->fetch_array();

    $cariID         = $hizmetbul['cariID'];
    $cariyaz        = $mysqli->query("select * from carifirma where id='$cariID' ")->fetch_array(); 

    $hizmetID       = $hizmetbul['hizmetID'];
    $hizmet         = $mysqli->query("select * from hizmet where id='$hizmetID' ")->fetch_array();

    $baslangic 		=   $hizmetbul['baslangic']; 
    $parabirimi 	=   $hizmetbul['parabirimi']; 
    $pbirimyaz      = $mysqli->query("select * from parabirimi where id='$parabirimi' ")->fetch_array();

     ?>
 
     <div class="main-content">
     
    <div class="breadcrumb">
    <h1><a href="?sy=cariayrinti&id=<?php echo $cariID; ?>"> <?php echo $cariyaz['firma']; ?></a> > <a href="?sy=cariayrintilar&id=<?php echo $carihizmet; ?>"><?php echo $hizmet['baslik'].' / '.$hizmetbul['baslik']; ?></a> > Ödeme Ekle </h1>
    <ul>
        <li><a href="index.php">Ana Sayfa</a></li>
        <li> İçerik Ekleme </li>                       
    </ul>
</div>
          
             <div class="separator-breadcrumb border-top"></div>
         
             <div class="row">
                 <div class="col-md-12">
                    
                     <p>  </p>
                     <div class="card mb-5">
                         <div class="card-body">
  
                     
                         <?php 
 if($_POST){ 
      
     $baslik			=  $_POST['baslik'];
     $fiyat				=  $_POST['fiyat'];

     $termin			=  $_POST['termin'];  
     if($termin=="Tek Seferlik"){
        $yenileme			=  0; 
     } else {
        $yenileme			=  $_POST['yenileme']; 
     }
      
     
     $onyazi			=  addslashes($_POST['onyazi']); 
      
     $sira				= trim($_POST['sira']); 
      
     $durum				= 1;
     $ekleyen			= $email;  
     $ip					= $_SERVER['REMOTE_ADDR']; 
      
                  
     $gonder  	= $mysqli->query(" insert into carikasa set  
      
     carihizmetID 		='$carihizmet', 
     cariID 			='$cariID',  
     hizmetID	 		='$hizmetID', 
     alacak 			='$fiyat', 
     parabirimi 		='$parabirimi', 
     termin	 			='$termin', 
     baslangic 			='$baslangic', 
     yenileme 			='$yenileme', 		
     kdv	 			= '18', 
     aciklama	 		= '$onyazi', 
     itarih		 		= now(),  
     
     ip					='$ip', 
     tarih				= now(),
     ekleyen			= '$ekleyen', 
     durum				= '0' 
  
   ");   
   

       
     if($gonder){
       
      
         header("Location:?sy=cariayrintilar&id=".$carihizmet);	
           
     } else { echo '<div class="alert alert-danger" role="alert">
                 <strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; }   	  
      
 } else { 
 ?>	
 
 
 
     <form action="" method="post" enctype="multipart/form-data" >
     
      
     
      <div id="hizbakkk"></div>
       
      
 <div class="form-group row mb-3">
         <label for="fiyat" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Fiyat * </label>
         <div class="col-sm-1" id="fiyat">
         <input type="text" name="fiyat" class="form-control" id="sira" placeholder="Fiyat" value="<?php echo $hizmet['fiyat']; ?>" aria-label="Amount (to the nearest dollar)" >  
          
         </div>

         <div class="input-group-prepend">
                <span class="input-group-text"><?php echo $pbirimyaz['simge']; ?></span>
            </div>
          
     </div> 
       
     <div class="form-group row">
		<label for="termin" class="col-sm-2 col-form-label"><i class="fa fa-calendar"></i> Termin </label>
		<div class="col-sm-6">
			<div class="ul-form__radio-inline">
			
				<label class=" ul-radio__position radio radio-primary form-check-inline">
					<input type="radio" name="termin" value="Yıllık" checked >
					<span class="ul-form__radio-font">Yıllık</span>
					<span class="checkmark"></span>
				</label>
				
				<label class="ul-radio__position radio radio-primary">
					<input type="radio" name="termin" value="Aylık">
					<span class="ul-form__radio-font">Aylık</span>
					<span class="checkmark"></span>
				</label>
					
				<label class="ul-radio__position radio radio-primary">
					<input type="radio" name="termin" value="Tek Seferlik">
					<span class="ul-form__radio-font">Tek Seferlik</span>
					<span class="checkmark"></span>
				</label>
				
			</div>
		</div>
	</div>


        
    <div class="form-group row">
         <label for="yenileme" class="col-sm-2 col-form-label">Yenileme </label>
         <div class="col-sm-2">
          <input type="date" name="yenileme" max="31.12.2050" class="form-control " id="yenileme" value="<?php $yil = date('Y')+1;  echo date("$yil-m-d"); ?>"  >
         </div>	 
    </div>
                  
   <div class="form-group row">
         <label for="onyazi" class="col-sm-2 col-form-label"> Not </label>
         <div class="col-sm-10">
         <textarea name="onyazi" class="form-control" id="onyazi" cols="30" rows="3" placeholder="Not" ></textarea>
              
         </div>
     </div>   
     
       
     <div class="form-group row">
     <label for="sira" class="col-sm-2 col-form-label">  </label>
         <div class="col-sm-10">
             <button type="submit" class="btn btn-primary ul-btn__text">İçerik Ekle</button>
          
         </div>
     </div>
     
         </form>
 
             <?php } ?>
                 </div>
             </div>
         </div>
     </div>            
 </div> 
                 