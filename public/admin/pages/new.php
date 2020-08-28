<?php require_once('../../../private/initialize.php'); ?>

<?php

requireLogin();

$subject = [];
$page = [];
$subjects = find_all_subjects();

// check if this is a POST request
// if not, redirect to the form (new.php)
if (is_post_request()) {

    $page['menu_name'] = $_POST['name'] ?? '';
    $page['subject_id'] =  $_POST['subject_id'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';

    // Validate form values sent by new.php
    // fetch the full subject for the subject id
    /* $subject = findSubjectByName($_POST['subject_name']); */

    $errors = validate_page($page);
    if (empty($errors)) {
        $result = insertPage($page);
        $new_id = mysqli_insert_id($db);
        if ($result === true) {
            $_SESSION['status_message'] = 'The page was created successfully.';
            redirectTo('/admin/pages/show.php?id=' . $new_id);                    
        }

    }

} else {
    
    $page['subject_id'] = $_GET['subject_id'] ?? '1';
    $page['menu_name'] = '';
    $page['position'] = '';
    $page['visible'] = '';
    $page['content'] = '';

    // $subject = findSubjectById($page['subject_id']);
    
}

?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="/admin/subjects/show.php?id=<?= $page['subject_id'] ?>">&laquo; Back to Subject View</a>
  <br/><br/>

  <div class="page new">
    
    <h1>Create Page</h1>

    <?= display_errors($errors) ?>

    <form action="/admin/pages/new.php" method="post">
      <dl>
        <dt>Subject</dt>
        <dd>
          <select name="subject_id">
            <?php

            while ($subject = mysqli_fetch_assoc($subjects)) {
                echo "<option value=\"" . $subject['id'] . "\"";
                if ($page['subject_id'] == $subject['id']) {
                    echo "selected";
                }echo ">" . $subject['menu_name'] . "</option>";
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
