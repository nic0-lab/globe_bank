<?php

// Performs all actions necessary to log in an admin
function logInAdmin($admin)
{
    // Regenerating the ID protects the admin from session fixation.
    session_regenerate_id();
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['user_name'] = $admin['user_name'];
    return true;
}

// Performs all actions necessary to log out an admin
function logOutAdmin()
{
    unset($_SESSION['admin_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['user_name']);
    // session_destroy(); // optional: destroys the whole session
    return true;
}

// is_logged_in() contains all the logic for determining if a
// request should be considered a "logged in" request or not.
// It is the core of require_login() but it can also be called
// on its own in other contexts (e.g. display one link if an admin
// is logged in and display another link if they are not)
function isLoggedIn() {
    // Having an admin_id in the session serves a dual-purpose:
    // - Its presence indicates the admin is logged in.
    // - Its value tells which admin for looking up their record.
    return isset($_SESSION['admin_id']);
}

// Call require_login() at the top of any page which needs to
// require a valid login before granting acccess to the page.
function requireLogin() {
    if(!isLoggedIn()) {
        redirectTo('/admin/login.php');
    } else {
        // Do nothing, let the rest of the page proceed
    }
}


?>
