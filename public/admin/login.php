<?php
require_once('../../private/initialize.php');

$errors = [];
$user_name = '';
$password = '';

if(is_post_request()) {

    $user_name = $_POST['user_name'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate form
    if (is_blank($user_name)) {
        $errors[] = 'User Name cannot be blank.';
    }

    if (is_blank($password)) {
        $errors[] = 'Password cannot be blank.';
    }

    // If no errors, try to login
    if (empty($errors)) {

        $admin = findAdminByUsername($user_name);

        if ($admin) {
            
            if (password_verify($password, $admin['hashed_password'])) {
                // password matches
                logInAdmin($admin);
                var_dump($admin);
                /* exit; */
                redirectTo('/admin/index.php');
            } else {
                // username found, but password does not match
                $errors[] = 'Log in was unsuccessful.';
            }
        } else {
            // no username found
            $errors[] = 'Log in was unsuccessful.';
        }
    }
    
}

?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  <h1>Log in</h1>

  <?php echo display_errors($errors); ?>

  <form action="login.php" method="post">
    User Name:<br />
    <input type="text" name="user_name" value="<?php echo h($user_name); ?>" /><br />
    Password:<br />
    <input type="password" name="password" value="" /><br />
    <input type="submit" name="submit" value="Submit"  />
  </form>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
