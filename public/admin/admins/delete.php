<?php require_once('../../../private/initialize.php'); ?>

<?php

requireLogin();

if (!isset($_GET['id'])) {
    redirectTo('/admin/admins/index.php');
}

$id = $_GET['id'];

$admin = findAdminById($id);

// check if this is a POST request
if (is_post_request()) {

    $result = deleteAdmin($admin['id']);
    if ($result === true) {        
        $_SESSION['status_message'] = 'The admin was deleted successfully.';
        redirectTo('/admin/admins/index.php');        
    }

}

?>

<?php $admin_title = 'Delete Admin'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="/admin/admins/index.php">&laquo; Back to List</a>
  <br/><br/>

  <div class="admin delete">
    
    <h1>Delete Admin</h1>
    <p>Are you sure you want to delete this admin?</p>
    <p class="item"><?= h($admin['user_name']) ?></p>
    
    <form action="/admin/admins/delete.php?id=<?= h(u($admin['id'])) ?>" method="post">
      <div class="operations">
        <input type="submit" value="Delete Admin" name="commit" />
      </div>
    </form>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
