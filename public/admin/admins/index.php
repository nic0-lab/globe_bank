<?php require_once('../../../private/initialize.php'); ?>

<?php

requireLogin();

$admins = findAllAdmins();

?>

<?php $page_title = 'Admins'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  <div class="admins listing">

    <h1>Admins</h1>

    <div class="actions">
      <a class="action" href="/admin/admins/new.php">Create New Admin</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
  	    <th>Email</th>
  	    <th>User Name</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while ($admin = mysqli_fetch_assoc($admins)) { ?>
        <tr>
          <td><?= h($admin['id']) ?></td>
          <td><?= h($admin['first_name']) ?></td>
          <td><?= h($admin['last_name']) ?></td>
          <td><?= h($admin['email']) ?></td>
    	    <td><?= h($admin['user_name']) ?></td>
          <td><a class="action" href="/admin/admins/show.php?id=<?= h(u($admin['id'])) ?>">View</a></td>
          <td><a class="action" href="/admin/admins/edit.php?id=<?= h(u($admin['id'])) ?>">Edit</a></td>
          <td><a class="action" href="/admin/admins/delete.php?id=<?= h(u($admin['id'])) ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php mysqli_free_result($admins); ?>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
