xdebug-log-filter
=================

A little script to monitor a web server log file for errors but filter out 
entire xdebug error and stack trace blocks that we want to ignore.

Installation
------------

1. Drop it into a folder somewhere on your development machine
1. Rename sample.config.php to domain.com.php
1. Edit the renamed config file
1. Update the path to the log file

Starting
--------

On the command line run:

    ./xdebug-log-filter domain.com.php

You shouldn't see any errors right away, but as errors are written to the log 
file, they should be spit out to your terminal.

Stopping
--------

Ctrl-C should stop it from running.

Filtering
---------

**When you update the config file, you need to stop and start the script again 
for the changes to take effect.**

As you develop, if you see the same error polluting your terminal making it 
harder to identify actual errors, you can add a regular expression to the 
config file to filter out that error.

Example
-------

The following error keeps showing up but it's from a 3rd party WordPress 
plugin, so I can't fix it myself.

	[31-Mar-2014 19:18:20 UTC] PHP Notice:  Woocommerce->template_url was called with an argument that is <strong>deprecated</strong> since version 2.1! WC_TEMPLATE_PATH constant in /home/roger/public_html/wp/wp-includes/functions.php on line 3006
	[31-Mar-2014 19:18:20 UTC] PHP Stack trace:
	[31-Mar-2014 19:18:20 UTC] PHP   1. {main}() /home/roger/public_html/wp/wp-admin/admin-ajax.php:0
	[31-Mar-2014 19:18:20 UTC] PHP   2. require_once() /home/roger/public_html/wp/wp-admin/admin-ajax.php:20
	[31-Mar-2014 19:18:20 UTC] PHP   3. require_once() /home/roger/public_html/wp/wp-load.php:34
	[31-Mar-2014 19:18:20 UTC] PHP   4. require_once() /home/roger/public_html/wp-config.php:41
	[31-Mar-2014 19:18:20 UTC] PHP   5. do_action() /home/roger/public_html/wp/wp-settings.php:347
	[31-Mar-2014 19:18:20 UTC] PHP   6. call_user_func_array() /home/roger/public_html/wp/wp-includes/plugin.php:429
	[31-Mar-2014 19:18:20 UTC] PHP   7. WooCommerce_Delivery_Notes->load_hooks() /home/roger/public_html/wp/wp-includes/plugin.php:429
	[31-Mar-2014 19:18:20 UTC] PHP   8. WooCommerce_Delivery_Notes_Print->__construct() /home/roger/public_html/content/plugins/woocommerce-delivery-notes/woocommerce-delivery-notes.php:100
	[31-Mar-2014 19:18:20 UTC] PHP   9. WooCommerce->__get() /home/roger/public_html/content/plugins/woocommerce-delivery-notes/woocommerce-delivery-notes.php:27
	[31-Mar-2014 19:18:20 UTC] PHP  10. _deprecated_argument() /home/roger/public_html/content/plugins/woocommerce/woocommerce.php:160
	[31-Mar-2014 19:18:20 UTC] PHP  11. trigger_error() /home/roger/public_html/wp/wp-includes/functions.php:3006

So, I look for a piece of this error message that is unique to this error.
Looks like `woocommerce-delivery-notes.php:27` is a good pick as it identifies 
the file and the line number. It should filter out only this particular error.

Now I open my config file and update my regexes to the following:

	$regexes = array(
		'@woocommerce-delivery-notes\.php:27@' // Deprecated function in Delivery Notes addon
	);

After restarting the script, I no longer see that error in my terminal on every 
page load. Woohoo!