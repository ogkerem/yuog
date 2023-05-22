
<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 rightSidebar  m-b30">

	<aside  class="side-bar">


<!-- <div class="widget p-a20">
	<div class="search-bx">
		<form role="search" method="get" action="/arama" >
			<div class="input-group">
<input type="text" class="form-control" name="kelime" placeholder="<?php echo dilbak($dilID, 16); ?>">
				<span class="input-group-btn">
					<button type="submit" class="btn"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</form>
	</div>
</div> -->
 
 
		<?php if($katID==0){   ?>
   <div class="widget widget_services p-a20">
		<div class="text-left m-b30">
			<h3 class="widget-title"><?php echo dilbak($dilID, 25); ?></h3>

		</div>
		<ul>
	<?php $kkbak = $mysqli->query("select * from urunkat where ustkatID='$konuID'  "); 
			
		while($kkyaz = $kkbak->fetch_array()){
			
			echo '<li><a title="Maestro Italy" href="'.seocuk($kkyaz['seo']).'">'.$kkyaz['baslik'].'</a></li>'; 
		}
			
	?>		 
		    

		</ul>
	</div> 
		
	<?php } elseif($katID>0){  ?>	
		
		
 	
		
		   <div class="widget widget_archives p-a20">
			<div class="text-left m-b30">
				<h3 class="widget-title"><?php echo dilbak($dilID, 3); ?></h3>
			</div>
			<ul>
				
	<?php $uubak = $mysqli->query("select * from urun where katID='$konuID' && durum='1' && dil='$dilID' order by sira asc "); 
			while($uuyaz = $uubak->fetch_array()){
				echo '<li><a  title="Maestro Italy" href="'.seocuk($uuyaz['seo']).'">'.$uuyaz['baslik'].'</a></li>'; 
			}	
		?>	 

			</ul>
		</div>     
		
		
		
		<?php }    ?>
		
		
		   <div class="widget recent-posts-entry p-a20">
				<div class="text-left m-b30">
					<h3 class="widget-title"><?php echo dilbak($dilID, 44); ?></h3>
				</div>                                    
				<div class="section-content">
					<div class="widget-post-bx">
						
	<?php $sonbak = $mysqli->query("select * from urun where dil='$dilID' && durum='1' order by sira asc limit 4 "); 
						
		while($sonyaz = $sonbak->fetch_array()){
			
			echo '<div class="widget-post clearfix">
		<div class="wt-post-media">
<a  title="Maestro Italy" href="'.seocuk($sonyaz['seo']).'"><img src="uploads/'.$sonyaz['kresim'].'" alt="'.$sonyaz['baslik'].'"></a>
		</div>
		<div class="wt-post-info">
			<div class="wt-post-header">
				<h6 class="post-title"> <a title="Maestro Italy" href="'.seocuk($sonyaz['seo']).'">'.$sonyaz['baslik'].'</a></h6>
			</div>                                                    
			<div class="">
			 	 <p>'.onyazi($sonyaz['onyazi'],7).'</p>     
			</div>                                        
		</div>
	</div>'; 
		}					
						
	?>					
 
						
				                                                 
					</div>
				</div>
			</div>
                                            
		<?php 
		 $etibak = $mysqli->query( "select * from etiket where konu='$konu' && konuID='$konuID' " );
		 if($etibak->num_rows>0){  
		 
		 ?>
		    <div class="widget widget_tag_cloud p-a20">
                <div class="text-left m-b30">
                  <h3 class="widget-title"><?php echo dilbak($dilID, 35);?></h3>
                </div>
                <div class="tagcloud">
                  <?php
                 
                  while ( $etyaz1 = $etibak->fetch_array() ) {

                    $etiket = $etyaz1[ 'baslik' ];
                    $eseoID = $etyaz1[ 'seo' ];

                    $etketbul = $mysqli->query( "select * from etiket where baslik='$etiket' && konuID!='$konuID' order by id desc " )->fetch_array();
                    $urlID1 = $etketbul[ 'seo' ];
                    $urlgit1 = $mysqli->query( "select * from seo where id='$urlID1' " )->fetch_array();

                    echo ' <a title="Maestro Italy" href="' . $urlgit1[ 'seo' ] . '">' . $etiket . '</a> ';
                  }

                  ?>
                </div>
              </div>

	         <?php } ?>                               

	   </aside>

</div>
