<?php require_once('../../../private/initialize.php'); ?>

<?php

$subject = [];
$subject['menu_name'] = $_POST['subject_name'] ?? '';

$page = [];
$page['position'] = '';
$page['visible'] = '';

// check if this is a POST request
// if not, redirect to the form (new.php)
if (is_post_request()) {

    $page['menu_name'] = $_POST['name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';

    // Validate form values sent by new.php
    $subject = findSubjectByName($subject['menu_name']);
    $page['subject_id'] =  $subject['id'];

    $errors = validate_page($page);
    if (empty($errors)) {
        $result = insertPage($page);
        $new_id = mysqli_insert_id($db);
        $_SESSION['status_message'] = 'The page was created successfully.';
        redirectTo('/admin/pages/show.php?id=' . $new_id);        
    }

} else {
    /* redirectTo('/admin/pages/new.php'); */
}

$subjects = find_all_subjects();


?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?= '/admin/pages/index.php' ?>">&laquo; Back to List</a>
  <br/><br/>

  <div class="page new">
    
    <h1>Create Page</h1>

    <?= display_errors($errors) ?>

    <form action="/admin/pages/new.php" method="post">
      <dl>
        <dt>Subject</dt>
        <dd>
          <select name="subject_name">
            <?php

            while ($elt = mysqli_fetch_assoc($subjects)) {
                echo "<option value=\"" . $elt['menu_name'] . "\"";
                if ($subject['menu_name'] == $elt['menu_name']) {
                    echo "selected";
                }echo ">" . $elt['menu_name'] . "</option>";
            }

            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php

            for ($i=1; $i <= 10; $i++) {
                echo "<option value=\"{$i}\"";
                if ($page['position'] == $i) {
                    echo "selected";
                }echo ">{$i}</option>";
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
                 if ($page['visible'] == 1 ) {
                     echo "checked";  
                 }
                 ?>
          />
        </dd>
      </dl>
      <dl>
        <dl>
          <dt>Name</dt>
          <dd><input name="name" type="text" value="<?= $page['menu_name'] ?? '' ?>"/></dd>
        </dl>
        <dl>
          <dl>
            <dt>Content</dt>
            <dd>
              <textarea cols="30" name="content" rows="10"><?= $page['content'] ?? '' ?></textarea>
            </dd>
          </dl>
          <div id="operations">
            <input type="submit" value="Create Page"/>
          </div>
    </form>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
