<navigation>
  <?php $nav_subjects = find_all_subjects(); ?>
  <ul class="subjects">
    <?php while ($nav_subject = mysqli_fetch_assoc($nav_subjects)) { ?>
      <li class="<?php if ($nav_subject['id'] == $subject_id) { echo 'selected'; } ?>">
        <a href="/index.php?subject_id=<?= h(u($nav_subject['id'])) ?>">
        <?= h($nav_subject['menu_name']) ?>  
      </a>

      <?php $nav_pages = findPagesBySubjectId($nav_subject['id']); ?>
      <ul class="pages" <?php if ($subject_id == $nav_subject['id']) { echo 'style="display:block;"'; } else { echo 'style="display:none;"'; } ?>>
        <?php while ($nav_page = mysqli_fetch_assoc($nav_pages)) { ?>
          <li class="<?php if ($nav_page['id'] == $page_id) { echo 'selected'; } ?>">
            <a href="/index.php?subject_id=<?= h(u($nav_subject['id'])) ?>&page_id=<?= h(u($nav_page['id'])) ?>">
              <?= h($nav_page['menu_name']) ?>  
            </a>
          </li>
        <?php } ?>
      </ul>
      <?php mysqli_free_result($nav_pages); ?>
      
    </li>
    <?php } ?>
  </ul>
  <?php mysqli_free_result($nav_subjects); ?>
</navigation>
