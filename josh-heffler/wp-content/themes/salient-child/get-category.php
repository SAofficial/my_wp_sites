<?php 

/*
Template Name: Get category
*/

get_header(); 

nectar_page_header($post->ID); 

//full page
$fp_options = nectar_get_full_page_options();
extract($fp_options);
?>

<div class="container-wrap" id="placeimg">
	<div class="container main-content">
			<div class="main_sec">
				<?php
				if (isset($_GET['cat_id']) || isset($_GET['title'])) {
                        if(isset($_GET['title'])){
                            $args=array(
							'posts_per_page' => -1,   
							'post_status' 		=> array('complete','publish') , 
							'post_type' => 'challenges',
							 's' => $_GET['title']
							 );
                        }
                        if(isset($_GET['cat_id'])){
                            $args=array(
							'posts_per_page' => -1,    
							'post_type' => 'challenges',
							'post_status' 		=> array('complete','publish') , 
							'tax_query' => array(
							    array(
							        'taxonomy' => 'category_custom', //double check your taxonomy name in you dd 
							        'field'    => 'id',
							        'terms'    => $_GET['cat_id'],
							    ),
							   ),
							 );
                        }
                        if(isset($_GET['cat_id']) && isset($_GET['title'])){
                             $args=array(
							'posts_per_page' => -1,    
							'post_status' 		=> array('complete','publish') , 
							'post_type' => 'challenges',
							 's' => $_GET['title'],
							    'relation' => 'OR',
							'tax_query' => array(
							    array(
							        'taxonomy' => 'category_custom', //double check your taxonomy name in you dd 
							        'field'    => 'id',
							        'terms'    => $_GET['cat_id'],
							    ),
							   ),
							 );
                        }
						
						$i=0;
						$j= 1;
							$wp_query = new WP_Query( $args );
						if ( $wp_query->have_posts() ) {
                      			while ( $wp_query->have_posts() ) {
	                      			$wp_query->the_post();
									$post_id 	= get_the_ID();
	                      			$title 	= get_post_meta( $post_id, 'challenge_title', true );
	                      			$thumbnail_id = get_post_thumbnail_id($post_id);
									$image_url = 	wp_get_attachment_image_url($thumbnail_id,'home-slide-img-mobile',true);
									$goal = get_post_meta( $post_id, 'financial_goal', true );
				 					// $image_url = str_replace('-1-150x150', '', $image_url);

	                      			// if ($i == 0 || $i == 3 || $i == 7) 
	                      			// {
	                      				if ($i== 0) {
						 		?>
						 		<div class="row">
						 		<div class="challenge">
						 		<?php
						 	}
						 	?>
						 			<div class="col span_4 <?= ($i == 2 || $i == 5 || $i == 8)? 'col_last':'asdsad'; ?>">
							    	<a href="<?= home_url().'/our-challenges?challenge_id='.$post_id; ?>">
							    	<div class="challenge_box">
							    		<div class="feagure">
							    			<img src="<?= $image_url; ?>">
							    		</div>
							    		<div class="challenge_name">
							    			<h3><?= $title; ?></h3>
							    			<?php
							    			$repeater_field = get_field('amount');
							    			$sum =0;
							    			  while( the_repeater_field('amount') ){

							    			  		 $sum = (int)get_sub_field('amount') + $sum;
							    			  }
							    			  if ($goal != 0) {
							    			  $reached = ($sum*100)/(int)$goal;

							    			  }
							    		/*	  echo "<pre>";
							    			  var_dump($reached);
							    			  echo "</pre>";*/
							    		
							    			?>
							    			<progress class="sb-progress sb-progress--orange" value="<?= $reached; ?>" max="100"></progress>
							    			<h2>$<?= $sum; ?></h2>
							    			<p>Pledged of $<?= $goal; ?></p>
							    		</div>
							    	</div>
							        </a>
							    </div>
							    <?php
							    // if ($i == 2 || $i == 5 || $i == 8) {
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
			}
		}
				?>
			</div>
		</div><!--/row-->
	</div><!--/container-->
</div><!--/container-wrap-->
<?php get_footer(); 