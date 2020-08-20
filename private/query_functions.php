<?php

/******************************************************************************/
/*                                      Subjects                              */
/******************************************************************************/

/**
 * Find all subjects
 *
 * Return an associative array
 */
function find_all_subjects($options=[])
{

    global $db;

    $visible = $options['visible'] ?? false;
    
    $sql = 'SELECT * FROM subjects ';
    if ($visible) {
        $sql .= "WHERE visible = true ";
    }
    $sql .= 'ORDER BY position, id ASC';
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;

}

/**
 * Find a subject by id
 *
 * Return an associative array with one result
 */
function findSubjectById($id, $options=[])
{

    global $db;

    $visible = $options['visible'] ?? false;
    
    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='" . mysqli_escape_string($db, $id) . "'";
    if ($visible) {
        $sql .= "AND visible = true ";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $subject;
}

/**
 * Find a subject by name
 *
 * Return an associative array with one result
 */
function findSubjectByName($name)
{

    global $db;
    
    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE menu_name='" . $name . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $subject;
}

/**
 * Insert a subject
 *
 * Return: true or exit
 */
function insertSubject($subject)
{

    global $db;

    $sql = "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysqli_escape_string($db, $subject['menu_name']) . "',";
    $sql .= "'" . mysqli_escape_string($db, $subject['position']) . "',";
    $sql .= "'" . mysqli_escape_string($db, $subject['visible']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

/**
 * Update a subject
 *
 *
 */
function updateSubject($subject)
{

    global $db;

    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name='" . mysqli_escape_string($db, $subject['menu_name']) . "', ";
    $sql .= "position='" . mysqli_escape_string($db, $subject['position']) . "', ";
    $sql .= "visible='" . mysqli_escape_string($db, $subject['visible']) . "' ";
    $sql .= "WHERE id='" . mysqli_escape_string($db, $subject['id']) . "' ";
    $sql .= "LIMIT 1";

    echo $sql;

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if ($result) {
        // redirectTo('/admin/subjects/show.php?id=' . $subject['id']);
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }    
}

/**
 * Delete a subject
 *
 *
 */
function deleteSubject($id)
{

    global $db;

    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE id='" . mysqli_escape_string($db, $id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if ($result) {
        return true; 
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
    
}

/**
 * Validate a subject
 *
 * Return: array $errors
 */
function validate_subject($subject) {

    $errors = [];

    // menu_name
    if(is_blank($subject['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }

    // position
    // Make sure we are working with an integer
    $position_int = (int) $subject['position'];
    if($position_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if($position_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $subject['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
        $errors[] = "Visible must be true or false.";
    }

    return $errors;

}

/******************************************************************************/
/*                                      Pages                                 */
/******************************************************************************/


/**
 * Find all pages
 *
 * Return an associative array
 */
function find_all_pages()
{

    global $db;
    
    $sql = 'SELECT * FROM pages ';
    $sql .= 'ORDER BY position, id ASC';
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;

}

/**
 * Find a page by id
 *
 * Return an associative array with one result
 */
function findPageById($id, $options=[])
{

    global $db;

    $visible = $options['visible'] ?? false;
    
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id='" . mysqli_escape_string($db, $id) . "'";
    if ($visible) {
        $sql .= "AND visible = true ";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $page;
}

/**
 * Insert a page
 *
 * Return: true or exit
 */
function insertPage($page)
{

    global $db;

    $sql = "INSERT INTO pages ";
    $sql .= "(subject_id, menu_name, position, visible, content) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysqli_escape_string($db, $page['subject_id']) . "',";
    $sql .= "'" . mysqli_escape_string($db, $page['menu_name']) . "',";
    $sql .= "'" . mysqli_escape_string($db, $page['position']) . "',";
    $sql .= "'" . mysqli_escape_string($db, $page['visible']) . "',";
    $sql .= "'" . mysqli_escape_string($db, $page['content']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

/**
 * Update a page
 *
 *
 */
function updatePage($page)
{

    global $db;

    $sql = "UPDATE pages SET ";
    $sql .= "subject_id='" . mysqli_escape_string($db, $page['subject_id']) . "', ";
    $sql .= "menu_name='" . mysqli_escape_string($db, $page['menu_name']) . "', ";
    $sql .= "position='" . mysqli_escape_string($db, $page['position']) . "', ";
    $sql .= "visible='" . mysqli_escape_string($db, $page['visible']) . "', ";
    $sql .= "content='" . mysqli_escape_string($db, $page['content']) . "' ";
    $sql .= "WHERE id='" . mysqli_escape_string($db, $page['id']) . "' ";
    $sql .= "LIMIT 1";

    echo $sql;

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

/**
 * Delete a page
 *
 *
 */
function deletePage($id)
{

    global $db;

    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id='" . mysqli_escape_string($db, $id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if ($result) {
        return true; 
    } else {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
    
}

/**
 * Validate a page
 *
 * Return: array $errors
 */
function validate_page($page) {

    $errors = [];

    // menu_name
    if(is_blank($page['menu_name'])) {
        $errors[] = "Name cannot be blank.";
    } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }
    $current_id = $page['id'] ?? '0';
    if (!has_unique_page_menu_name($page['menu_name'], $current_id)) {
        $errors[] = 'Menu name already in the database.';
    }

    // position
    // Make sure we are working with an integer
    $position_int = (int) $page['position'];
    if($position_int <= 0) {
        $errors[] = "Position must be greater than zero.";
    }
    if($position_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    // visible
    // Make sure we are working with a string
    $visible_str = (string) $page['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
        $errors[] = "Visible must be true or false.";
    }

    // content
    if(is_blank($page['content'])) {
        $errors[] = "Content cannot be blank.";
    }


    return $errors;

}

/**
 * Find all pages for a subject id
 *
 * Return an associative array
 */
function findPagesBySubjectId($subject_id, $options=[])
{

    global $db;

    $visible = $options['visible'] ?? false;
    
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE subject_id='" . mysqli_escape_string($db, $subject_id) . "' ";
    if ($visible) {
        $sql .= "AND visible = true ";
    }
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return $result;
}

/******************************************************************************/
/*                                      Admins                                */
/******************************************************************************/

/**
 * Find all admins
 *
 * Return an associative array
 */
function findAllAdmins()
{

    global $db;
    
    $sql = 'SELECT * FROM admins ';
    $sql .= 'ORDER BY id ASC';
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;

}

/**
 * Insert an admin
 *
 * Return: true or exit
 */
function insertAdmin($admin)
{

    global $db;

    $sql = "INSERT INTO admins ";
    $sql .= "(first_name, last_name, email, user_name, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysqli_escape_string($db, $admin['first_name']) . "',";
    $sql .= "'" . mysqli_escape_string($db, $admin['last_name']) . "',";
    $sql .= "'" . mysqli_escape_string($db, $admin['email']) . "',";
    $sql .= "'" . mysqli_escape_string($db, $admin['user_name']) . "',";
    $sql .= "'" . mysqli_escape_string($db, $admin['password']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if ($result) {
        return true;
    } else {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

/**
 * Validate an admin
 *
 * Return: array $errors
 */
function validateAdmin($admin) {

    $errors = [];

    // first name
    if(is_blank($admin['first_name'])) {
        $errors[] = "First name cannot be blank.";
    } elseif(!has_length($admin['first_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "First name must be between 2 and 255 characters.";
    }

    // last name
    if(is_blank($admin['last_name'])) {
        $errors[] = "Last name cannot be blank.";
    } elseif(!has_length($admin['last_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Last name must be between 2 and 255 characters.";
    }

    // email
    if(is_blank($admin['email'])) {
        $errors[] = "Email cannot be blank.";
    } elseif(!has_length($admin['email'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Email must be between 2 and 255 characters.";
    }
    // Verify if email is already in the database
    // If the request comes from new.php, id is set to 0
    // If the request comes from edit.php, id is set to $admin['id']
    $current_id = $admin['id'] ?? '0';
    if (!has_unique_admin_email($admin['email'], $current_id)) {
        $errors[] = 'Email already in the database.';
    }

    // user_name
    if (is_blank($admin['user_name'])) {
        $errors[] = "User name cannot be blank.";
    } elseif (!has_length($admin['user_name'], ['min' => 8, 'max' => 255])) {
        $errors[] = "User name must be between 8 and 255 characters.";
    }

    // password
    if (is_blank($admin['password'])) {
        $errors[] = "Password cannot be blank.";
    } elseif (!has_length($admin['password'], ['min' => 12, 'max' => 255])) {
        $errors[] = "Password must be between 12 and 255 characters.";
    } elseif (!(preg_match('/[[:lower:]]+/', $admin['password']) &&
              preg_match('/[[:upper:]]+/', $admin['password']) &&
              preg_match('/[[:digit:]]+/', $admin['password']) &&
              preg_match('/[[:punct:]]+/', $admin['password']))) {
        $errors[] = 'Password must contain al least 1 uppercase, 1 lowercase, 1 number, 1 symbol.';
    }

    // cpassword
    if (is_blank($admin['cpassword'])) {
        $errors[] = "Confirm password cannot be blank.";
    } // elseif (!has_length_greater_than($admin['cpassword'], ['min' => 12, 'max' => 255])) {
    //     $errors[] = "Confirmation Password must be between 2 and 255 characters.";
    // }

    // check passwords matching
    if ($admin['password'] != $admin['cpassword']) {
        $errors[] = "The passwords are not matching";
    }

    return $errors;

}

/**
 * Find an admin by id
 *
 * Return an array
 */
function findAdminById($id)
{

    global $db;

    
    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE id='" . mysqli_escape_string($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $admin = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $admin;
}

?>
