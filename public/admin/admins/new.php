<?php require_once('../../../private/initialize.php'); ?>

<?php

requireLogin();

$admin = [];

// check if this is a POST request
// if not, redirect to the form (new.php)
if (is_post_request()) {

    $admin['first_name'] = $_POST['first_name'] ?? '';
    $admin['last_name'] = $_POST['last_name'] ?? '';
    $admin['email'] = $_POST['email'] ?? '';
    $admin['user_name'] = $_POST['user_name'] ?? '';
    $admin['password'] = $_POST['password'] ?? '';
    $admin['cpassword'] = $_POST['cpassword'] ?? '';

    // Validate form values sent by new.php

    $errors = validateAdmin($admin);
    if (empty($errors)) {
        $result = insertAdmin($admin);
        $new_id = mysqli_insert_id($db);
        if ($result === true) {
            $_SESSION['status_message'] = 'The admin was created successfully.';
            redirectTo('/admin/admins/show.php?id=' . $new_id);                    
        }

    }

} else {
    /* redirectTo('/admin/admins/new.php'); */
}

$subjects = find_all_subjects();


?>

<?php $admin_title = 'Create Admin'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?= '/admin/admins/index.php' ?>">&laquo; Back to List</a>
  <br/><br/>

  <div class="admin new">
    
    <h1>Create Admin</h1>

    <?= display_errors($errors) ?>

    <form action="/admin/admins/new.php" method="post">
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
        <dd><input name="password" type="password" value="<?= $admin['password'] ?? '' ?>"/></dd>
      </dl>
      <dl>
        <dt>Confirm Password</dt>
        <dd><input name="cpassword" type="password" value="<?= $admin['cpassword'] ?? '' ?>"/></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Admin"/>
      </div>
    </form>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
