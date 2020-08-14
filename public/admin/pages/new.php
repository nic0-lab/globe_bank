<?php

require_once('../../../private/initialize.php');

$subjects = find_all_subjects();

/* $subject_count = mysqli_num_rows($subjects); */

?>

<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div id="content">
  
  <a class="back-link" href="<?= '/admin/pages/index.php' ?>">&laquo; Back to List</a>
  <br/><br/>

  <div class="page new">
    
    <h1>Create Page</h1>
    
    <form action="/admin/pages/create.php" method="post">
      <dl>
        <dt>Subject</dt>
        <dd>
          <select name="subject_name">
            <?php

            while ($subject = mysqli_fetch_assoc($subjects)) {
                echo "<option value=\"" . $subject['menu_name'] . "\"";
                echo ">" . $subject['menu_name'] . "</option>";
            }

            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php

            for ($i=1; $i <= 10; $i++) {
                echo "<option value=\"{$i}\"";
                echo ">{$i}</option>";
            }

            ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input name="visible" type="hidden" value="0" />
          <input name="visible" type="checkbox" value="1" />
        </dd>
      </dl>
      <dl>
        <dl>
          <dt>Name</dt>
          <dd><input name="name" type="text" value=""/></dd>
        </dl>
        <dl>
          <dl>
            <dt>Content</dt>
            <dd>
              <textarea cols="30" name="content" rows="10"></textarea>
            </dd>
          </dl>
          <div id="operations">
        <input type="submit" value="Create Page"/>
      </div>
    </form>
  </div>
  
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
