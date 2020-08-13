<?php require_once('../../../private/initialize.php'); ?>

<?php

if (!isset($_GET['id'])) {
    redirectTo('/admin/pages/index.php');
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

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="/admin/pages/index.php">&laquo; Back to List</a>
  <br/><br/>

  <div class="page edit">
    
    <h1>Edit Page</h1>
    
    <form action="/admin/pages/edit.php?id=<?= h(u($id)) ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input name="menu_name" type="text" value="<?= $menu_name ?>"/></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <option value="1"
                    <?php
                    if (!$_POST || $position == 1) {
                        echo 'selected';
                    }
                    ?>
            >1</option>
            <option value="2"
                    <?php
                    if ($position == 2) {
                        echo 'selected';
                    }
                    ?>
            >2</option>
            <option value="3"
                    <?php
                    if ($position == 3) {
                        echo 'selected';
                    }
                    ?>
            >3</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <!-- This hidden field serves as a default value for the checkbox "visible"
               If not here, a checkbox thas is not checked has no default value -->
          <input name="visible" type="hidden" value="0" />
          <input name="visible" type="checkbox" value="1"
                 <?php
                 if ($visible == 1) {
                     echo 'checked';                     
                 }
                 ?>
          />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Submit Page"/>
      </div>
    </form>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
