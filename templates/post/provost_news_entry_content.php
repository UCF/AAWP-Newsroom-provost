<?php

// entry content hook

function provost_news_entry_content() { ?>

  <div class="entry-content" itemprop="articleBody">
            <?php the_content(); ?>
  </div>

<?php }
