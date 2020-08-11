<?php

require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$page_title = 'Show Page';

?>

<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?= '/admin/pages/index.php' ?>">&laquo; Back to List</a>
  <br/><br/>
  <div class="page show">
    Page ID: <?= h($id) ?>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
