<?php
if (!isset($page_title)) { $page_title = 'Admin Area'; }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <title>GBI - <?= h($page_title); ?></title>
    <!-- <link href="<?= WWW_ROOT ?>../stylesheets/admin.css" rel="stylesheet" media="all" /> -->
    <link href="<?= WWW_ROOT ?>stylesheets/admin.css" rel="stylesheet" media="all" />
  </head>
  <body>

    <?php /*var_dump($_SERVER['SCRIPT_NAME']);*/ ?>

    <header>
      <h1>GBI Admin Area</h1>
    </header>

    <navigation>
      <ul>
        <li>User: <?= $_SESSION['username'] ?? '' ?></li>
        <li><a href="<?= WWW_ROOT . 'admin/index.php' ?>">Menu</a></li>
        <li><a href="<?= WWW_ROOT . 'admin/logout.php' ?>">Logout</a></li>
      </ul>
    </navigation>
