<?php require_once('../../../private/initialize.php'); ?>

<?php

requireLogin();

if (!isset($_GET['id'])) {
    echo 'test';
    /* redirectTo('/admin/admins/index.php'); */
}

$id = $_GET['id'];

$admin = [];

// check if this is a POST request
if (is_post_request()) {

    /* var_dump($_POST); */

    $admin['id'] = $id;
    $admin['first_name'] = $_POST['first_name'] ?? '';
    $admin['last_name']  = $_POST['last_name']  ?? '';
    $admin['email']      = $_POST['email']      ?? '';
    $admin['user_name']  = $_POST['user_name']  ?? '';
    $admin['password']   = $_POST['password']   ?? '';
    $admin['cpassword']  = $_POST['cpassword']  ?? '';

    // Validate form values
    $password_sent = !is_blank($admin['password']);
    $errors = validateAdmin($admin, ['password_required' => $password_sent]);
    if (empty($errors)) {
        $result = updateAdmin($admin);
        if ($result === true) {
            $_SESSION['status_message'] = 'The admin was updated successfully.';
            redirectTo('/admin/admins/show.php?id=' . $admin['id']);                    
        }

    } else {
        var_dump($admin);
    }

} else {
    $admin = findAdminById($id);
    /* var_dump($admin); */
}


?>

<?php $admin_title = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?= '/admin/admins/index.php' ?>">&laquo; Back to List</a>
  <br/><br/>

  <div class="admin edit">
    
    <h1>Edit Admin</h1>

    <?= display_errors($errors) ?>

    <form action="/admin/admins/edit.php?id=<?= h(u($id)) ?>" method="post">
      <dl>
        <dt>First Name</dt>
        <dd><input name="first_name" type="text" value="<?= $admin['first_name'] ?? '' ?>"/></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><input name="last_name" type="text" value="<?= $admin['last_name'] ?? '' ?>"/></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><input name="email" type="text" value="<?= $admin['email'] ?? '' ?>"/></dd>
      </dl>
      <dl>
        <dt>User Name</dt>
        <dd><input name="user_name" type="text" value="<?= $admin['user_name'] ?? '' ?>"/></dd>
      </dl>
      <dl>
        <dt>Password</dt>
        <dd><input name="password" type="password"/></dd>
      </dl>
      <dl>
        <dt>Confirm Password</dt>
        <dd><input name="cpassword" type="password"/></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Admin"/>
      </div>
    </form>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
