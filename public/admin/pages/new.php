<?php

require_once('../../../private/initialize.php');

$test = $_GET['test'] ?? '';

if ($test == '404') {
    error404();
} elseif ($test == '500') {
    error500();
} elseif ($test == 'redirect') {
    redirectTo('/admin/pages/index.php');
} else {
    echo 'No Error';
}


?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?= '/admin/pages/index.php' ?>">&laquo; Back to List</a>
  <br/><br/>

  <div class="page new">
    
    <h1>Create Page</h1>
    
    <form action="/admin/pages/create.php" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input name="menu_name" type="text" value=""/></dd>
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
        <input type="submit" value="Create Page"/>
      </div>
    </form>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
