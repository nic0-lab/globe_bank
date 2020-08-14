<?php

// subjects

/**
 * Find all subjects
 *
 * Return an associative array
 */
function find_all_subjects()
{

    global $db;
    
    $sql = 'SELECT * FROM subjects ';
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
function findSubjectById($id)
{

    global $db;
    
    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='" . $id . "'";
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
    $sql .= "'" . $subject['menu_name'] . "',";
    $sql .= "'" . $subject['position'] . "',";
    $sql .= "'" . $subject['visible'] . "'";
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
    $sql .= "menu_name='" . $subject['menu_name'] . "', ";
    $sql .= "position='" . $subject['position'] . "', ";
    $sql .= "visible='" . $subject['visible'] . "' ";
    $sql .= "WHERE id='" . $subject['id'] . "' ";
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
    $sql .= "WHERE id='" . $id . "' ";
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

// pages

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
function findPageById($id)
{

    global $db;
    
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id='" . $id . "'";
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
    $sql .= "'" . $page['subject_id'] . "',";
    $sql .= "'" . $page['menu_name'] . "',";
    $sql .= "'" . $page['position'] . "',";
    $sql .= "'" . $page['visible'] . "',";
    $sql .= "'" . $page['content'] . "'";
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
    $sql .= "subject_id='" . $page['subject_id'] . "', ";
    $sql .= "menu_name='" . $page['menu_name'] . "', ";
    $sql .= "position='" . $page['position'] . "', ";
    $sql .= "visible='" . $page['visible'] . "', ";
    $sql .= "content='" . $page['content'] . "' ";
    $sql .= "WHERE id='" . $page['id'] . "' ";
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
    $sql .= "WHERE id='" . $id . "' ";
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

?>
