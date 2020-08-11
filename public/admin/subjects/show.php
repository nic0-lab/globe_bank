<?php

require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$page_title = 'Show Subject';

?>

<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?= '/admin/subjects/index.php' ?>">&laquo; Back to List</a>

  <br/><br/>

  <div class="subject show">
    Page ID: <?= h($id) ?>
  </div>

  <br/><br/>

  <h3>Without urlencode()</h3>
  <a href="show.php?name=<?= ' Sed bibendum  '; ?>">Link</a><br/>
  <a href="show.php?company=<?= ' Nullam&rutrum.  '; ?>">Link</a><br/>
  <a href="show.php?query=<?= '!#*?'; ?>">Link</a><br/>

  <h3>With urlencode()</h3>
  <a href="show.php?name=<?= u(' Sed bibendum  '); ?>">Link</a><br/>
  <a href="show.php?company=<?= u(' Nullam&rutrum.  '); ?>">Link</a><br/>
  <a href="show.php?query=<?= u('!#*?'); ?>">Link</a><br/>

  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
