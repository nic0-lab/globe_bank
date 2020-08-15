<?php require_once('../../../private/initialize.php'); ?>

<?php

if (!isset($_GET['id'])) {
    redirectTo('/admin/pages/index.php');
}

$id = $_GET['id'];

// For populating the select with the subject name
$subjects = find_all_subjects();

$subject = [];
$page = [];

// check if this is a POST request
// if not, redirect to the form (new.php)
if (is_post_request()) {

    $page['id'] = $id;
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';

    var_dump($_POST);
    
    // Handle form values sent by new.php
    $subject = findSubjectByName($_POST['subject_name']);
    $page['subject_id'] = $subject['id'];

    $errors = validate_page($page);
    if (empty($errors)) {
        $result = updatePage($page);
        redirectTo('/admin/pages/show.php?id=' . $page['id']);
    }
    
    
} else {

    $page = findPageById($id);
    $subject = findSubjectById($page['subject_id']);

}

?>

<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="/admin/pages/index.php">&laquo; Back to List</a>
  <br/><br/>

  <div class="page edit">
    
    <h1>Edit Page</h1>

    <?= display_errors($errors) ?>

    <form action="/admin/pages/edit.php?id=<?= h(u($id)) ?>" method="post">
      <dl>
        <dt>Subject</dt>
        <dd>
          <select name="subject_name">
            <?php

            while ($elt = mysqli_fetch_assoc($subjects)) {
                echo "<option value=\"" . $elt['menu_name'] . "\"";
                if ($subject['menu_name'] == $elt['menu_name']) {
                    echo 'selected';
                }
                echo ">" . $elt['menu_name'] . "</option>";
            }

            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><input name="menu_name" type="text" value="<?= $page['menu_name'] ?>"/></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php

            for ($i=1; $i <= 10; $i++) {
                echo "<option value=\"{$i}\"";
                if ($page['position'] == $i) {
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
          <!-- This hidden field serves as a default value for the checkbox "visible"
               If not here, a checkbox thas is not checked has no default value -->
          <input name="visible" type="hidden" value="0" />
          <input name="visible" type="checkbox" value="1"
                 <?php
                 if ($page['visible'] == 1) {
                     echo 'checked';                     
                 }
                 ?>
          />
        </dd>
      </dl>
      <dl>
          <dl>
            <dt>Content</dt>
            <dd>
              <textarea cols="30" name="content" rows="10"><?= $page['content'] ?></textarea>
            </dd>
          </dl><div id="operations">
        <input type="submit" value="Submit Page"/>
      </div>
    </form>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
