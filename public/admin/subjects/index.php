<?php require_once('../../../private/initialize.php'); ?>

<?php

$subject_set = find_all_subjects();

?>

<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  <div class="subjects listing">

    <!-- Display status message for delete operations -->
    <?php if (isset($_SESSION['status_message'])) {
        echo '<div class="status">' . $_SESSION['status_message'] . '</div>';
        echo '<br>';
        unset($_SESSION['status_message']);
    }
    ?>

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
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while ($subject = mysqli_fetch_assoc($subject_set)) { ?>
        <tr>
          <td><?= h($subject['id']) ?></td>
          <td><?= h($subject['position']) ?></td>
          <td><?= $subject['visible'] == 1 ? 'true' : 'false' ?></td>
    	    <td><?= h($subject['menu_name']) ?></td>
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
