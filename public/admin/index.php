<?php require_once('../../private/initialize.php'); ?>

<?php requireLogin(); ?>

<?php $page_title = 'Admin Menu'; ?>
<?php include(SHARED_PATH . '/admin_header.php')?>

<div id="content">
  <div id="main-menu">
    <h2>Main Menu</h2>
    <ul>
      <li><a href="<?= '/admin/subjects/index.php' ?>">Subjects</a></li>
      <li><a href="<?= '/admin/admins/index.php' ?>">Admins</a></li>
    </ul>
  </div>
</div>

<?php include(SHARED_PATH . '/admin_footer.php')?>
