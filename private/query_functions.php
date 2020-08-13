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
function find_subject_by_id($id)
{
    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $subject;
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

?>
