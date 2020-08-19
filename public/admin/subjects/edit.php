<?php require_once('../../../private/initialize.php'); ?>

<?php

if (!isset($_GET['id'])) {
    redirectTo('/admin/subjects/index.php');
}

$id = $_GET['id'];

// check if this is a POST request
// if not, redirect to the form (new.php)
if (is_post_request()) {
    
    // Handle form values
    $subject = [];
    $subject['id'] = $id;
    $subject['menu_name'] = $_POST['menu_name'] ?? '';
    $subject['position'] = $_POST['position'] ?? '';
    $subject['visible'] = $_POST['visible'] ?? '';

    // Validation for data form
    $errors = validate_subject($subject);
    if (empty($errors)) {
        $result = updateSubject($subject);
        if ($result === true) {            
            $_SESSION['status_message'] = 'The subject was updated successfully.';
            redirectTo('/admin/subjects/show.php?id=' . $subject['id']);
        }

    }
    
} else {
    
    $subject = findSubjectById($id);

    /* $subject_set = find_all_subjects();
     * $subject_count = mysqli_num_rows($subject_set);
     * mysqli_free_result($subject_set); */
    
}

?>

<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="/admin/subjects/index.php">&laquo; Back to List</a>
  <br/><br/>

  <div class="subject edit">
    
    <h1>Edit Subject</h1>

    <?= display_errors($errors) ?>
    
    <form action="/admin/subjects/edit.php?id=<?= h(u($subject['id'])) ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input name="menu_name" type="text" value="<?= h($subject['menu_name']) ?>"/></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php

            for ($i=1; $i <= 10; $i++) {
                echo "<option value=\"{$i}\"";
                if ($subject['position'] == $i) {
                    echo 'selected';
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
                 if ($subject['visible'] == 1) {
                     echo 'checked';                     
                 }
                 ?>
          />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Submit Subject"/>
      </div>
    </form>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
