	
	<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 rightSidebar  m-b30">
            <aside  class="side-bar">
              <div class="widget p-a20">
                <div class="search-bx">
                  <form role="search" action="arama" method="get">
                    <div class="input-group">
                      <input name="kelime" type="text" class="form-control" placeholder="<?php echo dilbak($dilID, 10); ?>">
                      <span class="input-group-btn">
                      <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                      </span> </div>
                  </form>
                </div>
              </div>
			  
			  <div class="widget widget_services p-a20">
				<div class="text-left m-b30">
					<h3 class="widget-title"><?php echo dilbak($dilID,30); ?></h3>
					
				</div>
				<ul>
	  <?php $svbak = $mysqli->query( "select * from $kat where ustkatID='0' && katID='0'  && durum='1' && dil='$dilID' order by sira asc  " );
		
		  while ( $svyaz = $svbak->fetch_array() ) {
			  // $ustkatID 	= $svyaz['id'];
			  // $kksay 	= $mysqli->query("select * from $konu where ustkatID='$ustkatID' ")->num_rows;
			echo ' 
			<li><a href="' . seocuk( $svyaz[ 'seo' ] ) . '">' . $svyaz[ 'baslik' ] . '</a><!-- <span class="badge">'.$kksay.'</span>--></li>
			 ';

		  }
		  ?>
 
																
				</ul>
			</div>                
										
										
          
              <div class="widget widget_archives p-a20">
                <div class="text-left m-b30">
                  <h3 class="widget-title"><?php echo dilbak($dilID, 40); ?></h3>
                </div>
                <ul>
                  <?php
                  $svbak = $mysqli->query( "select * from $konu where dil='$dilID' && durum='1' order by sira asc limit 10 " );
                  while ( $svyaz = $svbak->fetch_array() ) {
                    echo '<li><a href="' . seocuk( $svyaz[ 'seo' ] ) . '">' . $svyaz[ 'baslik' ] . '</a></li>'; 
                  }
                  ?>
                </ul>
              </div>
			  
			  
		<!-- <div class="widget recent-posts-entry p-a20">
                <div class="text-left m-b30">
                  <h3 class="widget-title"><?php echo dilbak($dilID, 4); ?></h3>
                </div>
                <div class="section-content">
                  <div class="widget-post-bx">
                    <?php
                    $svbak = $mysqli->query( "select * from egitimler where dil='$dilID' && durum='1' order by sira asc limit 5" );
                    while ( $svyaz = $svbak->fetch_array() ) {
                      echo ' <div class="widget-post clearfix">
								<div class="wt-post-media">
									<img src="uploads/' . $svyaz[ 'kresim' ] . '" alt="' . $svyaz[ 'baslik' ] . '">
								</div>
								<div class="wt-post-info">
									<div class="wt-post-header">
										<h6 class="post-title"> <a href="' . seocuk( $svyaz[ 'seo' ] ) . '">' . $svyaz[ 'baslik' ] . '</a></h6>
									</div>                                                    
																				
								</div>
							</div> ';

                    }
                    ?>
			  </div>
			</div>
		  </div>  -->
			   
			   
            <!--  <div class="widget widget_tag_cloud p-a20">
                <div class="text-left m-b30">
                  <h3 class="widget-title"><?php echo dilbak($dilID, 31);?></h3>
                </div>
                <div class="tagcloud">
                  <?php
                  $etibak = $mysqli->query( "select * from etiket where konu='blog' && konuID='$konuID' " );
                  while ( $etyaz1 = $etibak->fetch_array() ) {

                    $etiket = $etyaz1[ 'baslik' ];
                    $eseoID = $etyaz1[ 'seo' ];

                    $etketbul = $mysqli->query( "select * from etiket where baslik='$etiket' && konuID!='$konuID' order by id desc " )->fetch_array();
                    $urlID1 = $etketbul[ 'seo' ];
                    $urlgit1 = $mysqli->query( "select * from seo where id='$urlID1' " )->fetch_array();

                    echo ' <a href="' . $urlgit1[ 'seo' ] . '">' . $etiket . '</a> ';
                  }

                  ?>
                </div>
              </div> -->
              <div class="widget p-a20">
                <div class="widget_social_inks">
                  <ul class="social-icons social-square social-darkest social-md">
                    <?php if($genelbak['facebook']!=""){?>
                    <li><a href="<?php echo $genelbak['facebook']; ?> " class="fa fa-facebook" target="_blank"></a></li>
                    <?php } ?>
                    <?php if($genelbak['twitter']!=""){?>
                    <li><a href="<?php echo $genelbak['twitter']; ?>" class="fa fa-twitter" target="_blank"></a></li>
                    <?php } ?>
                    <?php if($genelbak['linkedin']!=""){?>
                    <li><a href="<?php echo $genelbak['linkedin']; ?>" class="fa fa-linkedin" target="_blank"></a></li>
                    <?php } ?>
                    <?php if($genelbak['google']!=""){?>
                    <li><a href="<?php echo $genelbak['google']; ?>" class="fa fa-google-plus" target="_blank"></a></li>
                    <?php } ?>
                    <?php if($genelbak['youtube']!=""){?>
                    <li><a href="<?php echo $genelbak['youtube']; ?>" class="fa fa-youtube" target="_blank"></a></li>
                    <?php } ?>
                    <?php if($genelbak['instagram']!=""){?>
                    <li><a href="<?php echo $genelbak['instagram']; ?>" class="fa fa-instagram" target="_blank"></a></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </aside>
          </div>