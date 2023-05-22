
<?php
// geleni alma sorgusu

	$yaz=$mysqli->query("select * from sahap where menu='8' && dil='$dilID' && durum='on' && seo='$seoID'")->fetch_array();
	$id=$yaz['id'];
 ?>


	<?php 
$tasarim = $mysqli->query("select * from tasarim where id='8' && durum='1'")->fetch_array();
?>
	<section class="page-title" style="background-image: url(uploads/<?php echo $tasarim['resim']; ?>);">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 text-center">
					<div class="page-title-content">
						<h3 class="title text-white"><?php echo $yaz['baslik'];	?></h3>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="//<?php echo $genelbak['web']; ?>"><?php echo dilbak($dilID, 1); ?></a></li>
								<li class="breadcrumb-item active" aria-current="page">
								<?php echo dilbak($dilID, 3); ?></li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	
	
	
	<section class="blog-single-news pdt-110 pdb-90">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 col-lg-7">
					<div class="single-news-details news-wrapper mrb-30">
						<div class="single-news-content">
							<div class="news-thumb">
								<img src="uploads/<?php echo $yaz['resim']; ?>" class="img-full" alt="<?php echo $yaz['etiket']; ?>">
								<div class="news-date">
									<div class="entry-date"><?php echo $yaz['tarih']; ?></div>
								</div>
							</div>
							<div class="news-description">
								<h4 class="the-title"><?php echo $yaz['baslik']; ?></h4>
								<?php echo $yaz['icerik1']; ?>
							</div>
							<div class="single-news-tag-social-area clearfix">
							
								<div class="single-news-share text-left text-xl-right">
									
									<?php require_once("sections/share.php"); ?>
								</div>
							</div>
					
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-5 sidebar-right">
					<aside class="news-sidebar-widget">
						<div class="widget sidebar-widget widget-search mrb-30">
							<form class="search-form" action="arama" method="get">
								<label>
									<input type="search" name="kelime" class="search-field" placeholder="Ara">
								</label>
								<button type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
				
						<div class="widget sidebar-widget widget-popular-posts">
							<h4 class="mrb-30 single-blog-widget-title"><?php echo dilbak($dilID, 24); ?></h4>
							<?php
$gelen=$mysqli->query("select * from sahap where menu='8' && diL='$dilID' && durum='on' order by sira desc limit 6");
while($haberData=$gelen->fetch_array()) {
							?>
							<div class="single-post media mrb-20">
								<div class="post-image mrr-20">
									<img style="height:75px;" src="uploads/<?php echo $haberData['resim']; ?>" alt="<?php echo $haberData['etiket']; ?>">
								</div>
								<div class="post-content media-body align-self-center">
									<h5 class="mrb-5"><a href="<?php echo seocuk($haberData['seo']); ?>"><?php echo $haberData['baslik']; ?></a></h5>
									<span class="post-date"><i class="fa fa-clock-o mrr-5"></i><?php echo $haberData['tarih']; ?></span>
								</div>
							</div>
<?php } ?>
						</div>
						
						
								
						<div class="widget sidebar-widget widget-popular-posts">
							<h4 class="mrb-30 single-blog-widget-title"><?php echo dilbak($dilID, 3); ?></h4>
							<?php
$gelen=$mysqli->query("select * from sahap where menu='6' && diL='$dilID' && durum='on' order by sira desc limit 6");
while($haberData=$gelen->fetch_array()) {
							?>
							<div class="single-post media mrb-20">
								<div class="post-image mrr-20">
									<img style="height:75px;" src="uploads/<?php echo $haberData['resim']; ?>" 
									alt="<?php echo $haberData['etiket']; ?>">
								</div>
								<div class="post-content media-body align-self-center">
									<h5 class="mrb-5"><a href="<?php echo seocuk($haberData['seo']); ?>"><?php echo $haberData['baslik']; ?></a></h5>
									<span class="post-date"><i class="fa fa-clock-o mrr-5"></i><?php echo $haberData['tarih']; ?></span>
								</div>
							</div>
<?php } ?>
						</div>
					
					</aside>
				</div>
			</div>
		</div>
	</section>
