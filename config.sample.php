<?php
$debug_log_path = realpath( dirname( __FILE__ ) . '/../public_html/wp-content/debug.log' );

$regexes = array(
	'@woocommerce-delivery-notes\.php:27@' // Deprecated function in Delivery Notes addon
);
