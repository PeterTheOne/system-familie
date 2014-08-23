<?php
/*
 * Template Name: Kontakt
 * A custom page template for the Wielaender Kontakt-Page
 */

get_header(); ?>

<?php

function param($name) {
	return sanitizeFilter($_POST[$name]);
}

function sanitizeFilter($str) {
	return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function isEmpty($name) {
	return (strlen(trim($_POST[$name])) == 0);
}

function formSubmitted() {
	return ($_SERVER['REQUEST_METHOD'] == 'POST');
}

function formValid() {
	global $errMsg;
	
	if (isEmpty('Name')) {
		$errMsg['Name'] = 'Name fehlt.';
	}
	if (isEmpty('Email')) {
		$errMsg['Email'] = 'E-Mail fehlt.';
	}
	if (isEmpty('Message')) {
		$errMsg['Message'] = 'Message fehlt.';
	}
	
	return !isset($errMsg);
}

function printErrMsg() {
	global $errMsg;
	
	if (isset($errMsg)) {
		echo "<p>Bitte folgende Fehler korrigieren:</p>\n";
		echo "<ul>\n";
		foreach ($errMsg as $e) {
			echo "<li>$e</li>\n";
		}
		echo "</ul>\n";
	}
}

function processForm() {
	$EmailTo = "wielaender@system-familie.at";
	$Subject = "System Familie Kontakt: ";
	$Name = trim(sanitizeFilter($_POST['Name'])); 
	$Email = trim(sanitizeFilter($_POST['Email'])); 
	$Message = trim(sanitizeFilter($_POST['Message'])); 

	// prepare email body text
	$Body = "";
	$Body .= "Name: ";
	$Body .= $Name;
	$Body .= "\n";
	$Body .= "Email: ";
	$Body .= $Email;
	$Body .= "\n";
	$Body .= "Message: ";
	$Body .= $Message;
	$Body .= "\n";

	// send email 
	$success = mail($EmailTo, $Subject . $Name, $Body, "From: <$Email>");
}

function normForm() {
	if (formSubmitted() && formValid()) {
		processForm();
	}
}

normForm();
?>

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
?>

	<h2>Kontakt</h2>
	
<?php printErrMsg(); ?>
	<div id="contact-area">
		<form method="post" action="<?php echo the_permalink(); ?>">
			<input type="text" name="Name" id="Name" value="<?php echo param('Name'); ?>" placeholder="Name" />
			<input type="email" name="Email" id="Email" value="<?php echo param('EMail'); ?>" placeholder="E-Mail" />
			<textarea name="Message" rows="20" cols="20" id="Message" placeholder="Nachricht" ><?php echo param('Message'); ?></textarea>
			<input type="submit" name="submit" value="Abschicken" class="submit-button" />
		</form>
	</div>

<?php
	print $page_sections[0];
	print '</div>';
	print '<div id="column-two">';
	print $page_sections[1];
?>

	<div id="contact-map">
		<iframe width="410" height="303" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Wurmsergasse+39,+1150+Wien&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=39.099308,79.013672&amp;ie=UTF8&amp;hq=&amp;hnear=Wurmsergasse+39,+Rudolfsheim-F%C3%BCnfhaus+1150+Wien,+Austria&amp;ll=48.199283,16.320886&amp;spn=0.004026,0.009645&amp;z=14&amp;output=embed"></iframe>
	</div>

<?php
	print '</div>';

?>

	</div><!-- #content -->

<?php get_footer(); ?>