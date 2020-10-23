<?php 

/*
Template Name: Test Template
*/



get_header(); 
nectar_page_header($post->ID); 

//full page
$fp_options = nectar_get_full_page_options();
extract($fp_options);

?>

<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<div class="phone_menu_body manimated fadeIn">
	<div class="close_btn">
		<a href="javascript:void(0)" id="close_btn">×</a>
	</div>
	<div class="phone_menu">
	    <ul>
		    <li><a href="http://dev3.onlinetestingserver.com/josh-heffler/user-dashboard/" class="menu_active"><i class="fa fa-area-chart" aria-hidden="true"></i> Dashboard</a></li>
		    <li><a href="http://dev3.onlinetestingserver.com/josh-heffler/user-profile/"><i class="fa fa-address-card" aria-hidden="true"></i></i> Profile</a></li>
		    <li><a href="http://dev3.onlinetestingserver.com/josh-heffler/view-challange/"><i class="fa fa-history" aria-hidden="true"></i> Challenge History</a></li>
		    <li><a href="http://dev3.onlinetestingserver.com/josh-heffler/new-challenge/"><i class="fa fa-money" aria-hidden="true"></i> New Challenge</a></li>
		    <li><a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> Reviews</a></li>
		    <li><a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Financial Dashboard</a></li>
		    <li><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Setting</a></li>				
	    <ul>				    	
	</div>				
</div>
<div class="container-wrap" id="placeimg">
	
	<div class="container main-content">
		<div class="row">
			<div class="user_dashboard">
				<div class="col span_3">
					<div class="phone_menu_btn">
                	   <a href="javascript:void(0)" id="menuBtn"><h4>Menu</h4></a>
                    </div>
					<div class="menu_panel">
						<ul>
		                    <li><a href="http://dev3.onlinetestingserver.com/josh-heffler/user-dashboard/" class="menu_active"><i class="fa fa-area-chart" aria-hidden="true"></i> Dashboard</a></li>
		                    <li><a href="http://dev3.onlinetestingserver.com/josh-heffler/user-profile/"><i class="fa fa-address-card" aria-hidden="true"></i></i> Profile</a></li>
		                    <li><a href="http://dev3.onlinetestingserver.com/josh-heffler/view-challange/"><i class="fa fa-history" aria-hidden="true"></i> Challenge History</a></li>
		                    <li><a href="http://dev3.onlinetestingserver.com/josh-heffler/new-challenge/"><i class="fa fa-money" aria-hidden="true"></i> New Challenge</a></li>
		                    <li><a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i> Reviews</a></li>
		                    <li><a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Financial Dashboard</a></li>
		                    <li><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Setting</a></li>			
						</ul>
					</div>
				</div>
				<div class="col span_9 col_last">
					<div class="user_panel">
						<div class="col span_4">
							<a href="#">
							    <div class="user_box">
								    <div class="icon_box">
									    <img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/i1.png">
								    </div>
								    <div class="text_box">
									    <h4>New Challenge View Details</h4>
								    </div>
							    </div>
							</a>
						</div>
						<div class="col span_4">
							<a href="#">
							    <div class="user_box">
								    <div class="icon_box">
									    <img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/i2.png">
								    </div>
								    <div class="text_box">
									    <h4>Challenge History View Details</h4>
								    </div>
							    </div>
						    </a>
						</div>
						<div class="col span_4 col_last">
							<a href="#">
							    <div class="user_box">
								    <div class="icon_box">
									    <img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/i3.png">
								    </div>
								    <div class="text_box">
									    <h4>Financial Dashboard View Details</h4>
								    </div>
							    </div>
						    </a>
						</div>												
					</div>
					<div class="user_panel">
						<div class="col span_4">
							<a href="#">
							    <div class="user_box">
								    <div class="icon_box">
									    <img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/i4.png">
								    </div>
								    <div class="text_box">
									    <h4>My Profile View Details</h4>
								    </div>
							    </div>
						    </a>
						</div>
						<div class="col span_4">
							<a href="#">
							    <div class="user_box">
								    <div class="icon_box">
									    <img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/i5.png">
								    </div>
								    <div class="text_box">
									    <h4>Settings View Details</h4>
								    </div>
							    </div>
						    </a>
						</div>
						<div class="col span_4 col_last">
							<a href="#">
							    <div class="user_box">
								    <div class="icon_box">
									    <img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/i6.png">
								    </div>
								    <div class="text_box">
									    <h4>Reviews View Details</h4>
								    </div>
							    </div>
						    </a>
						</div>												
					</div>					
				</div>
			</div>
		</div><!--/row-->
	</div><!--/container-->
</div><!--/container-wrap-->
<div id="particles-js"></div>

<!-- stats - count particles -->
<div class="count-particles">
  <span class="js-count-particles">--</span> particles
</div> 
<script type="text/javascript">
particlesJS("particles-js", {"particles":{"number":{"value":60,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.25,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.3,"width":1},"move":{"enable":true,"speed":3,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});var count_particles, stats, update; stats = new Stats; stats.setMode(0); stats.domElement.style.position = 'absolute'; stats.domElement.style.left = '0px'; stats.domElement.style.top = '0px'; document.body.appendChild(stats.domElement); count_particles = document.querySelector('.js-count-particles'); update = function() { stats.begin(); stats.end(); if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) { count_particles.innerText = window.pJSDom[0].pJS.particles.array.length; } requestAnimationFrame(update); }; requestAnimationFrame(update);;
</script>
<?php get_footer(); ?>