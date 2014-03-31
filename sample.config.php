<?php
// Path to the log file
$log_path = '/home/roger/public_html/wp-content/debug.log' );

// Array of regular expressions. Each one will be run against each 
// XDebug error and stack trace. If ANY of the regular expressions
// match, the entire error and stack track will be filtered out
$regexes = array(
	//'@woocommerce-delivery-notes\.php:27@' // Deprecated function in Delivery Notes addon
);
