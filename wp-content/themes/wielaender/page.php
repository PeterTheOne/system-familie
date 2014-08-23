<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

	<div id="content" <?php if (is_front_page()) echo 'class="home"'; ?>>

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