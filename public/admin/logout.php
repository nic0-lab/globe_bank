<?php
require_once('../../private/initialize.php');

unset($_SESSION['username']);
// or you could use
// $_SESSION['username'] = NULL;

redirectTo('/admin/login.php');

?>
