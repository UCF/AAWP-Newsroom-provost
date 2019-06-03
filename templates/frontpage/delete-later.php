<?php function provost_news_cat_left($count){

  if($count == 1): // open column
    ?>
    <div class="row no-gutters">
      <div class="col-12 col-md-4">
    <?php

  endif;

  if($count < 3): //add two articles to the left side?>
    <article class="mb-5">
      <a href="<?php echo $link_url ?>" class="d-flex w-100 mb-2 media-background-container text-inverse text-decoration-none news-md-bg">
          <?php the_post_thumbnail( 'medium', array('class' => 'media-background object-fit-cover img-fluid')); ?>
      </a>
      <p class="font-italic published-date mb-0"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="entry-date pl-1"><?php echo esc_html( get_the_date('D M j')); ?></span></p>
      <h2 class="h6"><?php the_title(); ?></h2>
  </article>

<?php endif;

if($count == 2): //clouse column
  ?>
  </div>
  <div class="d-none d-md-flex justify-content-center col-md-1">
    <div class="d-flex flex-column h-100 vertical-divider"></div>
  </div>
  <?php
endif;

  if($count == 3):?>

  <?php
      $format = get_post_format() ? : 'standard';
      $link_url = get_the_permalink();
      if( get_field('pub_article_url') and ($format == 'link' )):
        $link_url = get_field( "pub_article_url" );
     endif;
  ?>


    <div class="col-12 col-md-7">
      <article>
        <a href="<?php echo $link_url; ?>"><?php the_post_thumbnail( 'medium-large', array('class' => 'img-fluid mb-3')); ?></a>
        <p class="font-italic published-date mb-0"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="entry-date pl-1"><?php echo esc_html( get_the_date('D M j')); ?></span></p>
        <h2 class="h4 "> <a href="<?php echo $link_url ?>" class="text-secondary"><?php the_title(); ?></a></h2>
        <p><?php the_excerpt(); ?></p>
    </article>

<?php endif;


}
