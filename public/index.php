<?php require_once('../private/initialize.php'); ?>

<?php

$page_id = '';
$subject_id = '';

/* if (isset($_GET['page_id'])) {
 *     $page_id = $_GET['page_id'];
 *     $page = findPageById($page_id);
 *     if (!$page) {
 *         redirectTo('/index.php');
 *     }
 *     $subject_id = $page['subject_id'];
 * }
 *  */
if (isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];
    $page_id = $_GET['page_id'] ?? '';
    
    // query the first page for the subject
    $pages = findPagesBySubjectId($subject_id);
    var_dump($pages);
    $page = mysqli_fetch_assoc($pages);
    if ($pages->num_rows == 0) {
        redirectTo('/index.php');
    }
    /* var_dump($page); */

    if (isset($_GET['page_id'])) {
        $page_id = $_GET['page_id'];
        $page = findPageById($page_id);
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
        // TODO add html escaping back in
        echo $page['content'];
    } else {
        include(SHARED_PATH . '/static_homepage.php');    
    }

    ?>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
