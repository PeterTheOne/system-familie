<?php
/*
 * Template Name: Philosophie
 * A custom page template for the Wielaender Philosophie-Page
 */

get_header(); ?>

	<div id="content" <?php if (is_front_page()) echo 'class="home"'; ?>>
	
	<!-- todo: mootools image switcher -->
	<div id="top-image-big-slide">
		<img src="<?php bloginfo('template_directory'); ?>/images/philo-big_01.jpg" alt="Was hinter uns liegt und 
		was vor uns liegt sind kleine Angelegenheiten verglichen mit dem, was in uns liegt. - Emerson" />
		<img src="<?php bloginfo('template_directory'); ?>/images/philo-big_02.jpg" alt="Ich glaub daran, dass das 
		größte Geschenk, das ich von jemanden empfangen kann, ist, gesehen, gehört, verstanden und berührt zu werden. 
		Das größte Geschenk, das ich geben kann, ist, den anderen zu sehen, zu hören, zu verstehen und zu berühren. 
		Wenn dies geschieht, entsteht Kontakt. - Virginia Satir" />
		<img src="<?php bloginfo('template_directory'); ?>/images/philo-big_03.jpg" alt="Du kannst nicht verhindern, 
		dass die Vögel der Sorge über deinen Kopf kreisen. Aber du kannst sie daran hindern, Nester in deinen Haaren 
		zu bauen. - Chinesisches Sprichwort" />
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