<?php

require_once('../../../private/initialize.php');

requireLogin();

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$subject = findSubjectById($id);
$page_set = findPagesBySubjectId($id);

?>

<?php $page_title = 'Show Subject'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?= '/admin/subjects/index.php' ?>">&laquo; Back to Subject List</a>

  <br/><br/>

  <div class="subject show">

    <div class="attributes">
      <dl>
        <dt>Subject Name</dt>
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

    <hr/>

    <div class="pages listing">

    <h2>Pages</h2>

    <div class="actions">
      <a class="action" href="/admin/pages/new.php?subject_id=<?= h(u($subject['id'])) ?>">Create New Page</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Name</th>
  	    <th>Content</th>
        <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($page = mysqli_fetch_assoc($page_set)) { ?>
        <?php $subject = findSubjectById($page['subject_id']); ?>
        <tr>
          <td><?php echo h($page['id']); ?></td>
          <td><?php echo h($page['position']); ?></td>
          <td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo h($page['menu_name']); ?></td>
          <td><?= substr(h($page['content']), 0, 30) . '...' ?></td>
          <td><a class="action" href="/admin/pages/show.php?id=<?= h(u($page['id'])); ?>">View</a></td>
          <td><a class="action" href="/admin/pages/edit.php?id=<?= h(u($page['id'])); ?>">Edit</a></td>
          <td><a class="action" href="/admin/pages/delete.php?id=<?= h(u($page['id'])); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php mysqli_free_result($page_set); ?>

    </div>
    
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
