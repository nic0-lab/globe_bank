<?php require_once('../../../private/initialize.php'); ?>

<?php

requireLogin();

$subject_set = find_all_subjects();

?>

<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  <div class="subjects listing">

    <h1>Subjects</h1>

    <div class="actions">
      <a class="action" href="/admin/subjects/new.php">Create New Subject</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Name</th>
  	    <th>Pages</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while ($subject = mysqli_fetch_assoc($subject_set)) { ?>
        <?php $pages_count = countPagesBySubjectId($subject['id']); ?>
        <tr>
          <td><?= h($subject['id']) ?></td>
          <td><?= h($subject['position']) ?></td>
          <td><?= $subject['visible'] == 1 ? 'true' : 'false' ?></td>
    	    <td><?= h($subject['menu_name']) ?></td>
          <td><?= $pages_count ?></td>
          <td><a class="action" href="/admin/subjects/show.php?id=<?= h(u($subject['id'])) ?>">View</a></td>
          <td><a class="action" href="/admin/subjects/edit.php?id=<?= h(u($subject['id'])) ?>">Edit</a></td>
          <td><a class="action" href="/admin/subjects/delete.php?id=<?= h(u($subject['id'])) ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php mysqli_free_result($subject_set); ?>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
