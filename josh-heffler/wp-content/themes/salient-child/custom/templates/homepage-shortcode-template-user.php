<style type="text/css">
	.owl-carousel .owl-item img{
		height: 280px !important;
	}
</style>
<div id="EXPLORE-sec" data-midnight="dark" data-bg-mobile-hidden="" class="wpb_row vc_row-fluid vc_row standard_section   " style="padding-top: 60px; padding-bottom: 60px; "><div class="row-bg-wrap"><div class="inner-wrap"><div class="row-bg    " style=""></div></div><div class="row-bg-overlay"></div></div><div class="col span_12 dark left">
	<div class="vc_col-sm-12 wpb_column column_container vc_column_container col no-extra-padding instance-1" data-t-w-inherits="default" data-border-radius="none" data-shadow="none" data-border-animation="" data-border-animation-delay="" data-border-width="none" data-border-style="solid" data-border-color="" data-bg-cover="" data-padding-pos="all" data-has-bg-color="false" data-bg-color="" data-bg-opacity="1" data-hover-bg="" data-hover-bg-opacity="1" data-animation="" data-delay="0"><div class="column-bg-overlay"></div>
		<div class="vc_column-inner">
			<div class="wpb_wrapper">
				
	<div class="wpb_text_column wpb_content_element  wpb_animate_when_almost_visible wpb_fadeInRight fadeInRight animated wpb_start_animation">
		<div class="wpb_wrapper">
			<h2>EXPLORE Top CHALLENGES</h2>

		</div>
	</div>
<div class="owl-carousel owl-theme owl-loaded owl-drag" data-enable-animation="" data-loop="false" data-animation-delay="0" data-autorotate="" data-autorotation-speed="5000" data-column-padding="10px" data-desktop-cols="4" data-desktop-small-cols="3" data-tablet-cols="2" data-mobile-cols="1">
	<div class="owl-stage-outer">
		<div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 1.4s ease 0s; width: 2490px;">
			
			<?php
			$the_query =  new WP_Query( array(
					'posts_per_page' 	=> 8,
                    'post_type'       	=> 'challenges',
                    'order'           	=> 'DESC',
                    'orderby' 			=> 'rand',
                    'post_status' 		=> array('active', 'complete','publish')
                     )
                  );

			if ( $the_query->have_posts() ) {
		            while ( $the_query->have_posts() ) {
		                 $the_query->the_post();
							$post_id 	= get_the_ID();
							$post_data  = get_post($post_id);
							$vuser_id   = $post_data->post_author;
							$title 		= get_post_meta( $post_id, 'challenge_title', true );
							$user_id    = get_post_meta( $post_id, 'author_id', true );
							$user_pic_id   = get_user_meta($user_id, '_thumbnail_id', true);

						
							 //$thumbnail_id = get_post_thumbnail_id($post_id);
							$img_url = 	wp_get_attachment_image_url($user_pic_id, 'home-slide-img-mobile',true);
					

							if ($user_pic_id)
							{



							?>
							<div class="owl-item" style="width: 311.25px;"><div class="carousel-item">
							<div class="img-with-aniamtion-wrap " data-max-width="100%" data-border-radius="none"><div class="inner">
								<a href="<?= home_url().'/view-uprofile?user_id='.$vuser_id ?>" target="_blank" class="">
									<img data-shadow="none" data-shadow-direction="middle" class="img-with-animation skip-lazy  animated-in" data-delay="0" height="" width="366" data-animation="fade-in" src="<?= $img_url; ?>" srcset="<?= $img_url; ?> 366w, <?= $img_url; ?> 222w" sizes="100vw" alt="" style="opacity: 1;"></a></div></div>
							<?php
						     }
						    else
						    {
						    ?>
						    	<div class="owl-item" style="width: 311.25px;"><div class="carousel-item">
							<div class="img-with-aniamtion-wrap " data-max-width="100%" data-border-radius="none"><div class="inner">
								<a href="<?= home_url().'/view-uprofile?user_id='.$vuser_id ?>" target="_blank" class="">
									<img data-shadow="none" data-shadow-direction="middle" class="img-with-animation skip-lazy  animated-in" data-delay="0" height="" width="366" data-animation="fade-in" src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/07/download.png" srcset="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/07/download.png 366w, http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/07/download.png 222w" sizes="100vw" alt="" style="opacity: 1;"></a></div></div>
							<?php
						    } 
						    ?>
					<div class="wpb_text_column wpb_content_element  wpb_animate_when_almost_visible wpb_fadeInUp fadeInUp animated wpb_start_animation">
						<div class="wpb_wrapper">
							<h3 style="text-align: center;"><?= $title; ?></h3>

						</div>
					</div>
				</div></div>
							<?php
											}
										}
			for ($i=1; $i <=8 ; $i++) { 
				?>
				
				<?php
						}			
			?>
			</div></div>
				</div>
			</div> 
		</div>
	</div> 
</div>
</div> 