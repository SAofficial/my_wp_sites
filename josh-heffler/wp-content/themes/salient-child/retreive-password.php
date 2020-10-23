<?php 

/*
Template Name: Retreive Password Template
*/

get_header(); 
nectar_page_header($post->ID); 

//full page
$fp_options = nectar_get_full_page_options();
extract($fp_options);

?>
<div class="container-wrap" id="placeimg">
	
	<div class="container main-content">
		<div class="row">
			<div class="main_sec">
				<div class="forget_pass">
				    <div class="col span_12">
					    <div class="login_clm">
					    	<div class="img_box">
					    		<img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/ok.png">
					    	</div>
						    <h2>Email Sent</h2>
						    <p>Instructions on how to reset your password has been sent at your registered email address, please follow the instructions & reset your account password</p>
					    </div>
				    </div>
				</div>			
			</div>
		</div><!--/row-->
	</div><!--/container-->
</div><!--/container-wrap-->
<?php get_footer(); ?>



