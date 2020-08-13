<?php require_once('../../../private/initialize.php'); ?>

<?php

if (!isset($_GET['id'])) {
    redirectTo('/admin/subjects/index.php');
}
$id = $_GET['id'];
$menu_name = '';
$position = '';
$visible = '';

// check if this is a POST request
// if not, redirect to the form (new.php)
if (is_post_request()) {
    
    // Handle form values sent by new.php

    $menu_name = $_POST['menu_name'] ?? '';
    $position = $_POST['position'] ?? '';
    $visible = $_POST['visible'] ?? '';

    echo 'Form parameters<br>';
    echo 'Menu name: ' . $menu_name . '<br>';
    echo 'Position: ' . $position . '<br>';
    echo 'Visible: ' . $visible . '<br>';
    
}

?>

<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="/admin/subjects/index.php">&laquo; Back to List</a>
  <br/><br/>

  <div class="subject edit">
    
    <h1>Edit Subject</h1>
    
    <form action="/admin/subjects/edit.php?id=<?= h(u($id)) ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input name="menu_name" type="text" value="<?= $menu_name ?>"/></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <option value="1">1</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input name="visible" type="hidden" value="0" />
          <input name="visible" type="checkbox" value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Submit Subject"/>
      </div>
    </form>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
