<?php

require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$page = findPageById($id);
$subject = findSubjectById($page['subject_id']);

$page_title = 'Show Page';

?>

<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?= '/admin/pages/index.php' ?>">&laquo; Back to List</a>
  <br/><br/>
  <div class="page show">

    <div class="attributes">
      <dl>
        <dt>Subject</dt>
        <dd><?= h($subject['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Name</dt>
        <dd><?= h($page['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?= h($page['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?= h($page['visible']) == '1' ? 'true' : 'false'; ?></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd><?= h($page['content']); ?></dd>
      </dl>
    </div>

  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
