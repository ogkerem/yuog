<?php 
	
	defined('YUOG') OR exit('No direct script access allowed / Yetkisiz Erişim ');
 
	?>
	<div class="main-content">
	
		
   <div class="breadcrumb">
                <h1>İçerik Silme</h1>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li> İçerikler </li>
                   
                     
                </ul>
            </div>
		 
            <div class="separator-breadcrumb border-top"></div>
   	
            <div class="row">
			
			<div class="col-md-12">
                    <div class="card text-left">

                        <div class="card-body">
                           
        
                        
 
							
	  <?php 
 $sitebak = $genelbak; 
$icerikxml = '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
		 
 
 
<url>
  <loc>https://www.'.$sitebak['web'].'/iletisim</loc>
    
  <changefreq>always</changefreq>
</url> ';

  

    $icerikbak		 = $mysqli->query("select * from seo where durum='1' ");
	while($icerikyaz = $icerikbak->fetch_array()){
  
    $icerikxml .= '<url>
  <loc>https://www.'.$sitebak['web'].'/'.$icerikyaz['seo'].'</loc>
   
  <changefreq>always</changefreq>
</url> ';
	}
	$icerikxml .= '</urlset>';
 $dosyaac	= fopen("../sitemap.xml",'w') or die("Dosya Açılamadı ");
	fwrite($dosyaac, $icerikxml);
	fclose($dosyaac);
?>
<br />
<br />
<br />
<h3>XML Oluşturma İşlemi Başarı İle Gerçekleştirilmiştir</h3>
<br />
<br />
<br />
<?php  header("Location:?sy=xml");?>



 
  

 				
			</div>
		</div>
	</div> 
  </div>
</div> 