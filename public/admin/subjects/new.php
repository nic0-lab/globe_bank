<?php require_once('../../../private/initialize.php'); ?>

<?php

$subject = [];
$subject['menu_name'] = $_POST['menu_name'] ?? '';
$subject['position'] = $_POST['position'] ?? '';
$subject['visible'] = $_POST['visible'] ?? '';

if (is_post_request()) {

    // Validate form values sent by new.php
    $errors = validate_subject($subject);
    if (empty($errors)) {

        $result = insertSubject($subject);
        $new_id = mysqli_insert_id($db);
        if ($result === true) {            
            $_SESSION['status_message'] = 'The subject was created successfully.';
            redirectTo('/admin/subjects/show.php?id=' . $new_id);
        }

    }

} else {
    /* redirectTo('/admin/subjects/new.php'); */
}

?>


<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?= '/admin/subjects/index.php' ?>">&laquo; Back to List</a>
  <br/><br/>

  <div class="subject new">
    
    <h1>Create Subject</h1>

    <?= display_errors($errors) ?>

    <form action="/admin/subjects/new.php" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input name="menu_name" type="text" value="<?= $subject['menu_name'] ?? '' ?>"/></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php

            for ($i=1; $i <= 10; $i++) {
                echo "<option value=\"{$i}\"";
                if ($subject['position'] == $i) {
                    echo "selected";
                }
                echo ">{$i}</option>";
            }

            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input name="visible" type="hidden" value="0" />
          <input name="visible" type="checkbox" value="1"
                 <?php
                 if ($subject['visible'] == 1 ) {
                     echo "checked";  
                 }
                 ?>
          />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Subject"/>
      </div>
    </form>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
