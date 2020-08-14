<?php require_once('../../../private/initialize.php'); ?>

<?php

// check if this is a POST request
// if not, redirect to the form (new.php)
if (is_post_request()) {
    
    // Handle form values sent by new.php

    $subject = [];
    $subject['menu_name'] = $_POST['menu_name'] ?? '';
    $subject['position'] = $_POST['position'] ?? '';
    $subject['visible'] = $_POST['visible'] ?? '';

    $result = insertSubject($subject);
    $new_id = mysqli_insert_id($db);
    redirectTo('/admin/subjects/show.php?id=' . $new_id);
    
} else {
    redirectTo('/admin/subjects/new.php');
}


?>
