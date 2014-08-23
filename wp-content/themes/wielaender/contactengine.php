<?php

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

function processForm() {
	$EmailTo = "petertheone@gmail.com";
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

	//echo $success;
	// redirect to success page 
	if ($success){
	  print "<meta http-equiv=\"refresh\" content=\"0;URL=contactthanks.php\">";
	}
	else{
	  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.htm\">";
	}
}

function normForm() {
	if (formSubmitted() && formValid()) {
		processForm();
	}
}

normForm();
?>