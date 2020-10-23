<?php 

/*
Template Name: Challenges1 Template
*/

get_header(); 

nectar_page_header($post->ID); 

//full page
$fp_options = nectar_get_full_page_options();
extract($fp_options);
?>
1
<div class="container-wrap" id="placeimg">
	<div class="container main-content">
			<div class="main_sec">

				<?php
				$i=0;
				$j= 1;
				 $categories = get_terms('category_custom');
				 foreach ($categories as $term) {
				 	$category_img = get_term_meta( $term->term_id, 'image_upload', true );
				 	$image_url = 	wp_get_attachment_image_url($category_img);
				 	$image_url = str_replace('-1-150x150', '', $image_url);
				 	// if ($i == 0 && $i == 3 && $i == 7) {
				 	if ($i== 0) {

				 		?>
				 		<div class="row">
				 		<div class="challenge">
				 		<?php
				 	}
				 	?>
				 			<div class="col span_4 <?= ($i == 2)? 'col_last':'asdsad'; ?>">
					    	<a href="<?= home_url().'/get-category?cat_id='.$term->term_id; ?>">
					    	<div class="challenge_box">
					    		<div class="feagure">
					    			<img src="<?= $image_url; ?>">
					    		</div>
					    		<div class="challenge_name">
					    			<h3><?= $term->name; ?></h3>
					    		</div>
					    	</div>
					        </a>
					    </div>
					    <?php
					    // if ($i == 2 && $i == 5 && $i == 8) {
					  	  if ($j == 3) {
							$i = -1;
					 		$j = 0;
				 		?>
				 			</div>
				 	</div>
				 		<?php
				 	}
				 	$i++;
				 	$j++;
				 }
				
				?>
			</div>
		</div><!--/row-->
	</div><!--/container-->
</div><!--/container-wrap-->
<?php get_footer(); ?>