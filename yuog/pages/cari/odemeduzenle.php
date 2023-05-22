<?php 
	 
     defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
    
    $id                 = $_GET['id'];
    $yaz                = $mysqli->query("select * from carikasa where id='$id' ")->fetch_array();

    $carihizmetID       = $yaz['carihizmetID'];
    $hizmetbul          = $mysqli->query("select * from carihizmet where id='$carihizmetID' ")->fetch_array();

    $cariID             = $yaz['cariID'];
    $cariyaz            = $mysqli->query("select * from carifirma where id='$cariID' ")->fetch_array(); 

    $hizmetID           = $yaz['hizmetID'];
    $hizmet             = $mysqli->query("select * from hizmet where id='$hizmetID' ")->fetch_array();

    $baslangic 			=   $hizmetbul['baslangic']; 
    $parabirimi 		=   $hizmetbul['parabirimi']; 

     ?>
 
     <div class="main-content"> 
    <div class="breadcrumb">
    <h1><a href="?sy=cariayrinti&id=<?php echo $cariID; ?>"> <?php echo $cariyaz['firma']; ?></a> > <a href="?sy=cariayrintilar&id=<?php echo $carihizmetID; ?>"><?php echo $hizmet['baslik'].' / '.$hizmetbul['baslik']; ?></a> > Ödeme Güncelleme </h1>
        <ul>
            <li><a href="index.php">Ana Sayfa</a></li>
            <li> İçerik Güncelleme </li>
        
            
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
     $ip				= $_SERVER['REMOTE_ADDR'];  
                  
     $gonder  	= $mysqli->query(" update carikasa set  
      
     carihizmetID 		='$carihizmetID', 
     cariID 			='$cariID',  
     hizmetID	 		='$hizmetID', 
     alacak 			='$fiyat', 
     parabirimi 		='$parabirimi', 
     termin	 			='$termin', 
     baslangic 			='$baslangic', 
     yenileme 			='$yenileme', 		
     kdv	 			= '18', 
     aciklama	 		= '$onyazi', 
    
     durum				= '0' 

     where id='$id'
  
   ");   
   

       
     if($gonder){
       
      
         header("Location:?sy=cariayrintilar&id=".$carihizmetID);	
           
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
        
 <div class="form-group row">
         <label for="fiyat" class="col-sm-2 col-form-label"><i class="fa fa-heading"></i> Fiyat * </label>
         <div class="col-sm-1" id="fiyat">
         <input type="text" name="fiyat" class="form-control" id="sira" placeholder="Fiyat" value="<?php echo $yaz['alacak'];  ?>" >  
          
         </div>
          
     </div> 
      
     <div class="form-group row">
		<label for="termin" class="col-sm-2 col-form-label"><i class="fa fa-calendar"></i> Termin </label>
		<div class="col-sm-6">
			<div class="ul-form__radio-inline">
			
				<label class=" ul-radio__position radio radio-primary form-check-inline">
					<input type="radio" name="termin" value="Yıllık" <?php if($yaz['termin']=="Yıllık"){ echo 'checked'; }  ?> >
					<span class="ul-form__radio-font">Yıllık</span>
					<span class="checkmark"></span>
				</label>
				
				<label class="ul-radio__position radio radio-primary">
					<input type="radio" name="termin" value="Aylık" <?php if($yaz['termin']=="Aylık"){ echo 'checked'; }  ?> >
					<span class="ul-form__radio-font">Aylık</span>
					<span class="checkmark"></span>
				</label>
					
				<label class="ul-radio__position radio radio-primary">
					<input type="radio" name="termin" value="Tek Seferlik" <?php if($yaz['termin']=="Tek Seferlik"){ echo 'checked'; }  ?> >
					<span class="ul-form__radio-font">Tek Seferlik</span>
					<span class="checkmark"></span>
				</label>
				
			</div>
		</div>
	</div>
 
    <div class="form-group row">
         <label for="yenileme" class="col-sm-2 col-form-label">Yenileme </label>
         <div class="col-sm-2">
    <input type="date" name="yenileme" max="31.12.2050" class="form-control " id="yenileme" value="<?php echo substr($yaz['tarih'],0,10); ?>"  >
         </div>	 
    </div>
                  
   <div class="form-group row">
         <label for="onyazi" class="col-sm-2 col-form-label"> Not </label>
         <div class="col-sm-10">
         <textarea name="onyazi" class="form-control" id="onyazi" cols="30" rows="3" placeholder="Not" ><?php echo $yaz['aciklama']; ?></textarea>
              
         </div>
     </div>   
     
       
     <div class="form-group row">
     <label for="sira" class="col-sm-2 col-form-label">  </label>
         <div class="col-sm-10">
             <button type="submit" class="btn btn-primary ul-btn__text">İçerik Güncelle</button>
          
         </div>
     </div>
     
         </form>
 
             <?php } ?>
                 </div>
             </div>
         </div>
     </div>            
 </div> 
                 