<?php require_once('../../../private/initialize.php'); ?>

<?php

requireLogin();

if (!isset($_GET['id'])) {
    redirectTo('/admin/subjects/index.php');
}

$id = $_GET['id'];

$subject = findSubjectById($id);

// check if this is a POST request
if (is_post_request()) {

    $result = deleteSubject($subject['id']);

    if ($result === true) {        
        $_SESSION['status_message'] = 'The subject was deleted successfully.';
        redirectTo('/admin/subjects/index.php');        
    }


}

?>

<?php $page_title = 'Delete Subject'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="/admin/subjects/index.php">&laquo; Back to List</a>
  <br/><br/>

  <div class="subject delete">
    
    <h1>Delete Subject</h1>
    <p>Are you sure you want to delete this subject?</p>
    <p class="item"><?= h($subject['menu_name']) ?></p>
    
    <form action="/admin/subjects/delete.php?id=<?= h(u($subject['id'])) ?>" method="post">
      <div class="operations">
        <input type="submit" value="Delete Subject" name="commit" />
      </div>
    </form>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
