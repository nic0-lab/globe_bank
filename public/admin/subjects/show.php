<?php

require_once('../../../private/initialize.php');

echo 'on show page';
echo '<br><br>';

/* $id = isset($_GET['id']) ? $_GET['id'] : '1'; */

$id = $_GET['id'] ?? '1'; // PHP > 7.0

echo h($id);
echo '<br><br>';



?>

<h3>Without urlencode()</h3>
<a href="show.php?name=<?= ' Sed bibendum  '; ?>">Link</a><br/>
<a href="show.php?company=<?= ' Nullam&rutrum.  '; ?>">Link</a><br/>
<a href="show.php?query=<?= '!#*?'; ?>">Link</a><br/>

<h3>With urlencode()</h3>
<a href="show.php?name=<?= u(' Sed bibendum  '); ?>">Link</a><br/>
<a href="show.php?company=<?= u(' Nullam&rutrum.  '); ?>">Link</a><br/>
<a href="show.php?query=<?= u('!#*?'); ?>">Link</a><br/>
