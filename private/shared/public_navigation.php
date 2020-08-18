<navigation>
  <?php $nav_subjects = find_all_subjects(['visible' => true]); ?>
  <ul class="subjects">
    <?php while ($nav_subject = mysqli_fetch_assoc($nav_subjects)) { ?>
      <?php /*if (!$nav_subject['visible']) { continue; }*/ ?>
      <li class="<?php if ($nav_subject['id'] == $subject_id) { echo 'selected'; } ?>">
        <a href="/index.php?subject_id=<?= h(u($nav_subject['id'])) ?>">
          <?= h($nav_subject['menu_name']) ?>  
        </a>

        <?php if ($nav_subject['id'] == $subject_id ) : ?>
          <?php $nav_pages = findPagesBySubjectId($nav_subject['id'], ['visible' => true]); ?>
          <ul class="pages">
            <?php while ($nav_page = mysqli_fetch_assoc($nav_pages)) { ?>
              <?php /*if (!$nav_page['visible']) { continue; }*/ ?>
              <li class="<?php if ($nav_page['id'] == $page_id) { echo 'selected'; } ?>">
                <a href="/index.php?subject_id=<?= h(u($nav_subject['id'])) ?>&page_id=<?= h(u($nav_page['id'])) ?>">
                  <?= h($nav_page['menu_name']) ?>  
                </a>
              </li>
            <?php } ?> <!-- END WHILE -->
          </ul>
          <?php mysqli_free_result($nav_pages); ?>
        <?php endif; ?> <!-- END IF -->
        
      </li>
    <?php } ?>
  </ul>
  <?php mysqli_free_result($nav_subjects); ?>
</navigation>
