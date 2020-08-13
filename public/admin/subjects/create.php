<?php require_once('../../../private/initialize.php'); ?>

<?php

// check if this is a POST request
// if not, redirect to the form (new.php)
if (is_post_request()) {
    
    // Handle form values sent by new.php

    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '';

    echo 'Form parameters<br>';
    echo 'Menu name: ' . $menu_name . '<br>';
    echo 'Position: ' . $position . '<br>';
    echo 'Visible: ' . $visible . '<br>';
    
} else {
    redirectTo('/admin/subjects/new.php');
}

$msg="";
$pattern="/SESA[0-9]{5}/";
$str="SESA12345468";
if (preg_match($pattern,$str))
{
    $msg="OK";
}
else
{
    $msg="NOK";
}
echo "msg=".$msg;


?>
