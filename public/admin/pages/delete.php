<?php require_once('../../../private/initialize.php'); ?>

<?php

requireLogin();

if (!isset($_GET['id'])) {
    redirectTo('/admin/pages/index.php');
}

$id = $_GET['id'];

$page = findPageById($id);

// check if this is a POST request
if (is_post_request()) {

    $result = deletePage($page['id']);
    if ($result === true) {        
        $_SESSION['status_message'] = 'The page was deleted successfully.';
        redirectTo('/admin/subjects/show.php?id=' . h(u($page['subject_id'])));        
    }

}

?>

<?php $page_title = 'Delete Page'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?= '/admin/subjects/show.php?id=' . h(u($page['subject_id'])) ?>">&laquo; Back to Subject Page</a>
  <br/><br/>

  <div class="page delete">
    
    <h1>Delete Page</h1>
    <p>Are you sure you want to delete this page?</p>
    <p class="item"><?= h($page['menu_name']) ?></p>
    
    <form action="/admin/pages/delete.php?id=<?= h(u($page['id'])) ?>" method="post">
      <div class="operations">
        <input type="submit" value="Delete Page" name="commit" />
      </div>
    </form>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
