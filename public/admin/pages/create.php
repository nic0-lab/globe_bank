<?php require_once('../../../private/initialize.php'); ?>

<?php

// check if this is a POST request
// if not, redirect to the form (new.php)
if (is_post_request()) {
    
    // Handle form values sent by new.php

    $page = [];
    $subject = findSubjectByName($_POST['subject_name']);

    $page['subject_id'] =  $subject['id'];
    $page['menu_name'] = $_POST['name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';

    $result = insertPage($page);
    $new_id = mysqli_insert_id($db);
    redirectTo('/admin/pages/show.php?id=' . $new_id);
    
} else {
    redirectTo('/admin/pages/new.php');
}


?>
