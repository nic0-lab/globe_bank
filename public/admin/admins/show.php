<?php

require_once('../../../private/initialize.php');

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$admin = findAdminById($id);

$page_title = 'Show Admin';

?>

<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?= '/admin/admins/index.php' ?>">&laquo; Back to List</a>
  <br/><br/>
  <div class="admin show">

    <h1>Admin: <?= h($admin['user_name']) ?></h1>

    <div class="attributes">
      <dl>
        <dt>First Name</dt>
        <dd><?= h($admin['first_name']) ?></dd>b
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><?= h($admin['last_name']) ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?= h($admin['email']) ?></dd>
      </dl>
      <dl>
        <dt>User Name</dt>
        <dd><?= h($admin['user_name']) ?></dd>
      </dl>
    </div>

  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
