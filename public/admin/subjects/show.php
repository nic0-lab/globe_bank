<?php

require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$subject = find_subject_by_id($id);

?>

<?php $page_title = 'Show Subject'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?= '/admin/subjects/index.php' ?>">&laquo; Back to List</a>

  <br/><br/>

  <div class="subject show">

    <div class="attributes">
      <dl>
        <dt>Menu Name</dt>
        <dd><?= h($subject['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?= h($subject['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?= h($subject['visible']) == '1' ? 'true' : 'false'; ?></dd>
      </dl>
    </div>
    
  </div>

  <br/><br/>

  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
