<?php
/*
Template name: search form
*/

get_header();
if(isset($_GET['search'])){
    $cat = $_GET['cat_post'];
    $post_title = $_GET['title'];
    
            if(isset($_GET['title']) && !empty($post_title)){
                     wp_redirect(home_url().'/get-category/?&title='."$post_title".'');
                }
            if(isset($_GET['cat_post']) && !empty($cat)){
                    wp_redirect(home_url().'/get-category/?cat_id='."$cat".'');
            }
            if(isset($_GET['cat_post']) && isset($_GET['title'])){
                    wp_redirect(home_url().'/get-category/?cat_id='."$cat".'&title='."$post_title".'');
            }   
}
?>
<br><br><br><br><br><br>


<form method="get">
    <input type="text" placeholder="Search By Keyword" name="title">
    <select name="cat_post">
        <option value="">Search by category</option>
    <?php
    	$terms = get_terms([
		    'taxonomy' => 'category_custom',
		    'hide_empty' => true,
		]);
	foreach ($terms as $term) {
		echo "<option value=".$term->term_id.">".$term->name."</option>";
	}
    ?>
    </select>
    <input type="submit" name="search" value="Search">
</form>
<?php

get_footer();