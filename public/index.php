<?php require_once('../private/initialize.php'); ?>

<?php

$page_id = '';
$subject_id = '';
/* $visible = true; */

$preview = false;
if (isset($_GET['preview'])) {
    //previewing should require admin to be logged in
    $preview = $_GET['preview'] == 'true' ? true : false;
}
// the preview is for all pages, visible and non visible
// so $visible must be false for the SQL query
$visible = !$preview;

if (isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];
    $page_id = $_GET['page_id'] ?? '';
    
    // query the first page for the subject
    $pages = findPagesBySubjectId($subject_id, ['visible' => $visible]);
    /* var_dump($pages); */
    $page = mysqli_fetch_assoc($pages);
    if ($pages->num_rows == 0) {
        redirectTo('/index.php');
    }
    /* var_dump($page); */

    if (isset($_GET['page_id'])) {
        $page_id = $_GET['page_id'];
        $page = findPageById($page_id, ['visible' => $visible]);
    }

}

?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

  <?php include(SHARED_PATH . '/public_navigation.php'); ?>

  <div id="page">

    <?php

    if (isset($page)) {
        // show the page from the database
        $allowed_tags = '<div><img><h1><h2><p><br><strong><em><ul><li>';
        echo strip_tags($page['content'], $allowed_tags);
    } else {
        include(SHARED_PATH . '/static_homepage.php');    
    }

    ?>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
