	<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
	
	$konu 	= "sistem";
	$id 	= $_GET['id'];
	$yaz 	= $mysqli->query("select * from $konu where id='$id' ")->fetch_array();
	
	$dil 	= $yaz['dil']; 
	$dilyaz = $mysqli->query("select * from diller where id='$dil' ")->fetch_array();
	
	$seoID 	= $yaz['seoID'];
	$seoyaz	= $mysqli->query("select * from seo where id='$seoID' ")->fetch_array();
 
	
	?>
	 
	 <div class="main-content">
	
   <div class="breadcrumb">
                <h1><a href="?sy=<?php echo $konu; ?>"> Sistem (  Menüler) </a>    </h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li>İçerik Güncelleme</li>
                    <li> <span class="badge badge-pill badge-warning p-2 m-1">UYARI!!! Bu alanda etkin değilseniz işlem yapmayınız</span>  </li> 
                     
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
	
	 
	 $menu			= $_POST['menu'];
	 $durum			= $_POST['durum'];	 
	 $sef			= $_POST['sef'];	 
	 $ust			= $_POST['ust'];	 
	$sira			= (int)$_POST['sira'];

    $dname          = $_POST['dname'];
    $dsef           = $_POST['dsef'];
    $dilID          = $_POST['dilID'];


	 $baslik		= $_POST['baslik'];
	 $onyazi		= $_POST['onyazi'];
	 $ustresim		= $_POST['ustresim'];
	 $kodu			= $_POST['kodu'];
	 $fiyat			= $_POST['fiyat'];
	 $renk			= $_POST['renk'];
	 $marka			= $_POST['marka'];
	 $kat1			= $_POST['kat1'];
	 $kat2			= $_POST['kat2'];
	 $kat3			= $_POST['kat3'];
	 $icon			= $_POST['icon'];
	 $resim			= $_POST['resim'];
	 $icerik1		= $_POST['icerik1'];
	 $teknik1		= $_POST['teknik1'];
	 $video			= $_POST['video'];
	 $videokod		= $_POST['videokod'];
	 $keywords		= $_POST['keywords'];
	 $description	= $_POST['description'];
	 $etiket		= $_POST['etiket'];
	 $yazar			= $_POST['yazar'];
	 $tarih			= $_POST['tarih'];
	 $galeri		= $_POST['galeri'];
	 $pdf			= $_POST['pdf'];
	 $dosya			= $_POST['dosya'];
	 $seo			= $_POST['seo'];
	 $anasayfa		= $_POST['anasayfa'];
	$obaslik1		= $_POST['obaslik1'];
	$oacik1			= $_POST['oacik1'];
	$otip1			= $_POST['otip1'];
	$obaslik2		= $_POST['obaslik2'];
	$oacik2			= $_POST['oacik2'];
	$otip2			= $_POST['otip2'];
	$obaslik3		= $_POST['obaslik3'];
	$oacik3			= $_POST['oacik3'];
	$otip3			= $_POST['otip3'];
	 
	
	$seosor			= $mysqli->query("select * from seo where seo='$sef' && id!='$seoID' ");
	$seoyazz		= $seosor->fetch_array(); 
	$seosay 		= $seosor->num_rows;		  
	if($seosay>0){
		$sonurl = $sef.'-'.rand(0,100);
	} else { 
		$sonurl = $sef;
	}

	$seoguncelle = $mysqli->query("update seo set seo='$sonurl', durum='$durum' where id='$seoID' ");
 
	$gonder  	= $mysqli->query(" update $konu set  
		
		menu 				='$menu', 
		durum 				='$durum', 
		sef 				='$sef', 
		ust 				='$ust', 
		sira 				='$sira', 
		dil 				='$dil', 
		
		baslik 				='$baslik', 
		onyazi 				='$onyazi', 
		ustresim			='$ustresim', 
		kodu				='$kodu', 
		fiyat				='$fiyat', 
		renk				='$renk', 
		marka				='$marka', 
		kat1				='$kat1', 
		kat2				='$kat2', 
		kat3				='$kat3', 
		icon				='$icon', 
		resim				='$resim', 
		icerik1				='$icerik1', 
		teknik1				='$teknik1', 
		video				='$video', 
		videokod			='$videokod', 
		keywords			='$keywords', 
		description			='$description', 
		etiket				='$etiket', 
		yazar				='$yazar', 
		tarih				='$tarih', 
		galeri				='$galeri', 
		pdf					='$pdf', 
		dosya				='$dosya', 
		seo					='$seo' ,
		anasayfa			='$anasayfa' ,
		 
		obaslik1			='$obaslik1',
		otip1				='$otip1',
		oacik1				='$oacik1',
		obaslik2			='$obaslik2',
		otip2				='$otip2',
		oacik2				='$oacik2',
		obaslik3			='$obaslik3',
		oacik3				='$oacik3',
		otip3				='$otip3' 
	  
		where id='$id'
	 
	  ");   
	  
	if($gonder){
	 
        $mysqli->query("delete from sistemdil where menuID='$id' ");

        $dnamesay = count($dname);
        for($x=0 ; $x<$dnamesay; $x++){
            $dname1     = $dname[$x];
            $dsef1      = $dsef[$x];
            $dilID1     = $dilID[$x];
            
            echo $dname1.'=>'.$dsef1.' <br> '; 
            $mysqli->query("insert into sistemdil (menuID, dilID, dname,dsef) values ('$id', '$dilID1', '$dname1', '$dsef1') ");
        }


	  
	 header("Location:?sy=".$konu."&islem=basarili");	
		  
	} else { echo '<div class="alert alert-danger" role="alert">
				<strong class="text-capitalize">Hata!</strong>Hata İşlem Başarısız :(  
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div> <br /> <a href="javascript:history.back(-1)">Geri Dön</a>'; }   	  
	 
	} else { 
?>	



	<form action="" method="post" enctype="multipart/form-data" >
	
 
<!-- 	<div class="form-group row">
		<label for="baslik" class="col-sm-3 col-form-label"> <i class="fa fa-language"></i> Dil </label>
		
	 
    <div class="col-2">
    
	  <select class="custom-select task-manager-list-select" name="dil">
	  
	  <?php $dilbak = $mysqli->query("select * from diller order by sira asc ");
	 
			while($dilyaz = $dilbak->fetch_array()){
				if($dilyaz['id']==$dil){
				echo '<option value="'.$dilyaz['id'].'" selected>'.$dilyaz['baslik'].'</option>';
				} else {
				echo '<option value="'.$dilyaz['id'].'">'.$dilyaz['baslik'].'</option>';
				}
			}

?>  
	 </select>
	 
	 
    </div>
     
 </div> -->
 
 
 
<div class="form-group row">
	<label for="menu" class="col-sm-3 col-form-label">Menü  Genel * </label>
	<div class="col-sm-6">
	 <input type="text" name="menu" class="form-control" id="menu" placeholder="Menü İsmi" value="<?php echo $yaz['menu']; ?>" required >
	</div>
</div>
	<hr> 
  
<?php 
    $dbak = $mysqli->query("select * from diller order by sira asc ");
        while($dyaz = $dbak->fetch_array()){
        $dilIDD     = $dyaz['id'];
        $sdyaz      = $mysqli->query("select * from sistemdil where menuID='$id' && dilID='$dilIDD' ")->fetch_array();   
 ?>

<div class="form-group row">
	<label for="menu" class="col-sm-3 col-form-label"><?php echo $dyaz['baslik']; ?> İsmi * </label>
	<div class="col-sm-4">
	 <input type="text" name="dname[]" class="form-control" id="dname" placeholder="Menü İsmi" value="<?php echo $sdyaz['dname']; ?>" required >
	</div>
</div>
  
<div class="form-group row">
	<label for="dsef" class="col-sm-3 col-form-label"><?php echo $dyaz['baslik']; ?> Sef (Sefe Uygun Yazın)* </label>
	<div class="col-sm-4">
	 <input type="text" name="dsef[]" class="form-control" id="dsef" placeholder="Menü Sef" value="<?php echo $sdyaz['dsef']; ?>" required >
	</div>
</div>

<input type="hidden" name="dilID[]" value="<?php echo $dyaz['id']; ?>">

<hr>
<?php } ?>


 
<div class="form-group row">
	<label for="sira" class="col-sm-3 col-form-label">Sıra * </label>
	<div class="col-sm-1">
	 <input type="text" name="sira" class="form-control" id="sira" placeholder="Menü İsmi" value="<?php echo $yaz['sira']; ?>" required >
	</div>
</div>
	 
   
 
<div class="form-group row">
	<label for="sef" class="col-sm-3 col-form-label">SEF * </label>
	<div class="col-sm-6">
	 <input type="text" name="sef" class="form-control" id="sef" placeholder="Menü İsmi" value="<?php echo $seoyaz['seo']; ?>" required >
	</div>
</div>
	 
 

<div class="form-group row">
	<label for="durum" class="col-sm-3 col-form-label">  Durum </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="durum">
		 
		  <input name="durum" type="checkbox" <?php if($yaz['durum']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div> 

<div class="form-group row">
	<label for="ust" class="col-sm-3 col-form-label">  Üst Menü </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-success mr-3" id="ust">
		 
		  <input name="ust" type="checkbox" <?php if($yaz['ust']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>


 
 
 
<hr>


<div class="form-group row">
	<label for="baslik" class="col-sm-3 col-form-label">Başlık </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="baslik">
		 
		  <input name="baslik" type="checkbox"  <?php if($yaz['baslik']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
 
<div class="form-group row">
	<label for="onyazi" class="col-sm-3 col-form-label">Önyazı </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="onyazi">
		 
		  <input name="onyazi" type="checkbox"  <?php if($yaz['onyazi']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>


		 
<div class="form-group row">
	<label for="ustresim" class="col-sm-3 col-form-label">Üst Resim </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="ustresim">
		 
		  <input name="ustresim" type="checkbox"  <?php if($yaz['ustresim']=="on"){ echo 'checked'; } ?> > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
		 
<div class="form-group row">
	<label for="kodu" class="col-sm-3 col-form-label">Kodu </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="kodu">
		 
		  <input name="kodu" type="checkbox" <?php if($yaz['kodu']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>

<div class="form-group row">
	<label for="fiyat" class="col-sm-3 col-form-label">Fiyat </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="fiyat">
		 
		  <input name="fiyat" type="checkbox" <?php if($yaz['fiyat']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>


<div class="form-group row">
	<label for="renk" class="col-sm-3 col-form-label">Renk </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="renk">
		 
		  <input name="renk" type="checkbox"  <?php if($yaz['renk']=="on"){ echo 'checked'; } ?> > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>

<div class="form-group row">
	<label for="marka" class="col-sm-3 col-form-label">Marka </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="marka">
		 
		  <input name="marka" type="checkbox"  <?php if($yaz['marka']=="on"){ echo 'checked'; } ?> > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
		
<div class="form-group row">
	<label for="kat1" class="col-sm-3 col-form-label">  Kategori </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="kat1">
		 
		  <input name="kat1" type="checkbox" <?php if($yaz['kat1']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>		

  <div class="form-group row">
	<label for="kat2" class="col-sm-3 col-form-label">  Orta Kategori </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="kat2">
		 
		  <input name="kat2" type="checkbox"  <?php if($yaz['kat2']=="on"){ echo 'checked'; } ?> > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
		
<div class="form-group row">
	<label for="kat3" class="col-sm-3 col-form-label">  Alt Kategori </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="kat3">
		 
		  <input name="kat3" type="checkbox" <?php if($yaz['kat3']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>  
				
<div class="form-group row">
	<label for="icon" class="col-sm-3 col-form-label">  İcon  </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="icon">
		 
		  <input name="icon" type="checkbox" <?php if($yaz['icon']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>		

<div class="form-group row">
	<label for="resim" class="col-sm-3 col-form-label">  Resim  </label>
	<div class="col-sm-3"> 
	<label class="switch switch-primary mr-3" id="resim">  
		  <input name="resim" type="checkbox" <?php if($yaz['resim']=="on"){ echo 'checked'; } ?>  >  
		<span class="slider"></span>
	</label> 
</div> 
</div>
				
<div class="form-group row">
	<label for="icerik1" class="col-sm-3 col-form-label">  İçerik  </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="icerik1">
		 
		  <input name="icerik1" type="checkbox" <?php if($yaz['icerik1']=="on"){ echo 'checked'; } ?>   > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
				
<div class="form-group row">
	<label for="teknik1" class="col-sm-3 col-form-label">  Teknik  </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="teknik1">
		 
		  <input name="teknik1" type="checkbox"  <?php if($yaz['teknik1']=="on"){ echo 'checked'; } ?> > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
				
<div class="form-group row">
	<label for="video" class="col-sm-3 col-form-label">  Video (Resim ve Youtube URL)  </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="video">
		 
		  <input name="video" type="checkbox"  <?php if($yaz['video']=="on"){ echo 'checked'; } ?> > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>	
				

<div class="form-group row">
	<label for="videokod" class="col-sm-3 col-form-label">  Video Kodu (Youtube Kod)  </label>
	<div class="col-sm-3"> 
	<label class="switch switch-primary mr-3" id="videokod"> 
		  <input name="videokod" type="checkbox"  <?php if($yaz['videokod']=="on"){ echo 'checked'; } ?> >  
		<span class="slider"></span>
	</label> 
</div> 
</div>	


<div class="form-group row">
	<label for="keywords" class="col-sm-3 col-form-label">  Keywords  </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="keywords">
		 
		  <input name="keywords" type="checkbox" <?php if($yaz['keywords']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>

<div class="form-group row">
	<label for="description" class="col-sm-3 col-form-label">  Description  </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="description">
		 
		  <input name="description" type="checkbox" <?php if($yaz['description']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>

 <div class="form-group row">
	<label for="etiket" class="col-sm-3 col-form-label">  Etiket  </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="etiket">
		 
		  <input name="etiket" type="checkbox" <?php if($yaz['etiket']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
 
 
 <div class="form-group row">
	<label for="yazar" class="col-sm-3 col-form-label">  Yazar  </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="yazar">
		 
		  <input name="yazar" type="checkbox" <?php if($yaz['yazar']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>
  
<div class="form-group row">
	<label for="tarih" class="col-sm-3 col-form-label">  Tarih  </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="tarih">
		 
		  <input name="tarih" type="checkbox" <?php if($yaz['tarih']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>


<div class="form-group row">
	<label for="galeri" class="col-sm-3 col-form-label">  Resim Galeri </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="galeri">
		 
		  <input name="galeri" type="checkbox"  <?php if($yaz['galeri']=="on"){ echo 'checked'; } ?> > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>

<div class="form-group row">
	<label for="pdf" class="col-sm-3 col-form-label">  Dosya (PDF) Tek </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="pdf">
		 
		  <input name="pdf" type="checkbox"  <?php if($yaz['pdf']=="on"){ echo 'checked'; } ?> > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>


<div class="form-group row">
	<label for="dosya" class="col-sm-3 col-form-label">  Dosyalar </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="dosya">
		 
		  <input name="dosya" type="checkbox" <?php if($yaz['dosya']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>



<div class="form-group row">
	<label for="anasayfa" class="col-sm-3 col-form-label">  Anasayfa </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="anasayfa">
		 
		  <input name="anasayfa" type="checkbox" <?php if($yaz['anasayfa']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>



<div class="form-group row">
	<label for="seo" class="col-sm-3 col-form-label">  Seo URL </label>
	<div class="col-sm-3">
	  
	<label class="switch switch-primary mr-3" id="seo">
		 
		  <input name="seo" type="checkbox" <?php if($yaz['seo']=="on"){ echo 'checked'; } ?>  > 
		  
		<span class="slider"></span>
	</label>
			 
</div> 
</div>

   
   
<div class="form-group row">
	<label for="obaslik1" class="col-sm-3 col-form-label"> Ek Başlık 1 / Format </label>
	<div class="col-sm-1"> 
	<label class="switch switch-primary mr-3" id="obaslik1"> 
		  <input name="obaslik1" type="checkbox" <?php if($yaz['obaslik1']=="on"){ echo 'checked'; } ?>  >  
		<span class="slider"></span>
	</label> 
</div> 	


<div class="col-sm-3">
	<input type="text" name="oacik1" class="form-control" id="oacik1" placeholder="Menü İsmi" value="<?php echo $yaz['oacik1']; ?>" >
</div>

<div class="col-sm-2"> 
		<select class="custom-select task-manager-list-select" name="otip1" >
			 
		<option value="baslik" <?php if($yaz['otip1']=="baslik"){ echo 'selected'; } ?> > Başlık Alanı </option> 
		<option value="onyazi" <?php if($yaz['otip1']=="onyazi"){ echo 'selected'; } ?> > Ön Yazı Alanı </option> 
		<option value="icerik" <?php if($yaz['otip1']=="icerik"){ echo 'selected'; } ?> > İçerik Alanı </option> 
			 
 </select>
	 
 
</div>
		
</div>
 

<div class="form-group row">
	<label for="obaslik2" class="col-sm-3 col-form-label"> Ek Başlık 1 / Format </label>
	<div class="col-sm-1"> 
	<label class="switch switch-primary mr-3" id="obaslik2"> 
		  <input name="obaslik2" type="checkbox" <?php if($yaz['obaslik2']=="on"){ echo 'checked'; } ?>  >  
		<span class="slider"></span>
	</label> 
</div> 	

<div class="col-sm-3">
	<input type="text" name="oacik2" class="form-control" id="oacik2" placeholder="Menü İsmi" value="<?php echo $yaz['oacik2']; ?>" >
</div>

<div class="col-sm-2"> 
			<select class="custom-select task-manager-list-select" name="otip2" > 
		<option value="baslik" <?php if($yaz['otip2']=="baslik"){ echo 'selected'; } ?> > Başlık Alanı </option> 
		<option value="onyazi" <?php if($yaz['otip2']=="onyazi"){ echo 'selected'; } ?> > Ön Yazı Alanı </option> 
		<option value="icerik" <?php if($yaz['otip2']=="icerik"){ echo 'selected'; } ?> > İçerik Alanı </option> 
			 
 </select>
	 
 
</div>
		
</div>
 

<div class="form-group row">
	<label for="obaslik3" class="col-sm-3 col-form-label"> Ek Başlık 1 / Format </label>
	<div class="col-sm-1"> 
	<label class="switch switch-primary mr-3" id="obaslik3"> 
		  <input name="obaslik3" type="checkbox" <?php if($yaz['obaslik3']=="on"){ echo 'checked'; } ?>   >  
		<span class="slider"></span>
	</label> 
</div> 	

<div class="col-sm-3">
	<input type="text" name="oacik3" class="form-control" id="oacik3" placeholder="Menü İsmi" value="<?php echo $yaz['oacik3']; ?>" >
</div>

<div class="col-sm-2"> 
	 <select class="custom-select task-manager-list-select" name="otip3" > 
		<option value="baslik" <?php if($yaz['otip3']=="baslik"){ echo 'selected'; } ?> > Başlık Alanı </option> 
		<option value="onyazi" <?php if($yaz['otip3']=="onyazi"){ echo 'selected'; } ?> > Ön Yazı Alanı </option> 
		<option value="icerik" <?php if($yaz['otip3']=="icerik"){ echo 'selected'; } ?> > İçerik Alanı </option> 
 </select> 
</div> 
</div>



		
		 <hr/>	

<div class="form-group row">
	<label for="ekleyen" class="col-sm-3 col-form-label">Ekleyen </label>
	<div class="col-sm-2">
	 <?php echo $yaz['ekleyen']; ?> 
		
						
		</div>
		 
	</div>	

<div class="form-group row">
	<label for="eklemetarih" class="col-sm-3 col-form-label">Ekleme Tarihi </label>
	<div class="col-sm-2">
	 <?php echo $yaz['tarih']; ?> 
		
						
		</div>
		 
	</div>	
 
<div class="form-group row">
	<label for="eklemetarih" class="col-sm-3 col-form-label">IP </label>
	<div class="col-sm-2">
	 <?php echo $yaz['ip']; ?> 
		
						
		</div>
		 
	</div>	
 
 
 
	<div class="form-group row">
	<label for="sira" class="col-sm-3 col-form-label">  </label>
		<div class="col-sm-3">
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
				