<?php require_once('../private/initialize.php'); ?>

<?php

$page_id = '';

if (isset($_GET['id'])) {
    $page_id = $_GET['id'];
    $page = findPageById($page_id);
    if (!$page) {
        redirectTo('/index.php');
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
