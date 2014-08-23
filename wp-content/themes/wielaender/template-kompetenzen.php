<?php
/*
 * Template Name: Kompetenzen
 * A custom page template for the Wielaender Kompetenzen-Page
 */

get_header(); ?>

	<div id="content" <?php if (is_front_page()) echo 'class="home"'; ?>>
	
	<div id="top-image-big">
		<img src="<?php bloginfo('template_directory'); ?>/images/kompetenzen-tauchen-big.jpg" alt="Schnorcheln oder Tiefseetauchen?" />
	</div>

<?php 

	// to columns by:	http://wordpress.org/support/profile/krimsly
	// link:			http://wordpress.org/support/topic/two-column-posts

	if ( have_posts() ) while ( have_posts() ) : the_post(); 	

		$content = get_the_content();
		$content = apply_filters('the_content', $content);
		$page_sections = explode("[--section--]", $content);
	
	endwhile;
	
	print '<div id="column-one">';
	print $page_sections[0];
	print '</div>';
	print '<div id="column-two">';
	print $page_sections[1];
	print '</div>';

?>

	</div><!-- #content -->

<?php get_footer(); ?>