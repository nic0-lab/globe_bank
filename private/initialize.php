<?php

// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define('PRIVATE_PATH', dirname(__FILE__));
define('PROJECT_PATH', dirname(PRIVATE_PATH));
define('PUBLIC_PATH', PROJECT_PATH . '/public');
define('SHARED_PATH', PRIVATE_PATH . '/shared');

// Assign the root URL to a PHP constant
// Can dynamically find everything in URL up to "/public"
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 1;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

/* $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
 * $admin_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
 * define("ADMIN_ROOT", $admin_root);
 *  */

/* var_dump($_SERVER['SCRIPT_NAME']); */
/* var_dump(WWW_ROOT); */


require_once('functions.php');


?>