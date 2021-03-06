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
        <li>User: <?= $_SESSION['user_name'] ?? '' ?></li>
        <li><a href="<?= WWW_ROOT . 'admin/index.php' ?>">Menu</a></li>
        <li><a href="<?= WWW_ROOT . 'admin/logout.php' ?>">Logout</a></li>
      </ul>
    </navigation>

    <!-- Display status message for CRUD operations -->
    <?php if (isset($_SESSION['status_message'])) {
        echo '<div class="status">' . $_SESSION['status_message'] . '</div>';
        echo '<br>';
        unset($_SESSION['status_message']);
    }
    ?>
