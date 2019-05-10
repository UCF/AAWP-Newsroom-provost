<?php

// entry footer look

function provost_news_entry_header() { ?>

  <div class="row justify-content-center ">
    <div class="col-12 col-md-10">
      <header class="entry-header">
         <!--<div class="meta post-category mt-4 d-flex small mb-2 "><?php //if(function_exists("seopress_display_breadcrumbs")) { seopress_display_breadcrumbs(); } ?></div>-->
         <div class="meta post-category mt-5 mb-4 ">
               <?php
               foreach((get_the_category()) as $category){?>
                   <a href="<?php esc_url( get_category_link( $category->cat_ID ) );  ?>"  class="bg-primary  py-1 px-3"> <?php echo $category->name; ?> </a>
                 <?php
               }
               ?>
           </div>
         <div class="mb-4">
           <h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
           <?php if ( ! has_excerpt() ): ?>
           <div class="post-excerpt lead mb-1"> <? //the_excerpt(); ?></div>
           <?php endif; ?>
           <div class="ucf-publish my-1 small text-uppercase">
             <span class="post-author" itemscope itemprop="author" itemtype="http://schema.org/Person"><?php echo esc_html('By:' ); ?> <span itemprop="name"><?php the_author();?></span> &#183; </span>
             <span class="publish-date text-default-aw" itemprop="datePublished" content="<?php echo get_the_date("Y-d-m"); ?>"> <?php echo get_the_date("M d, Y"); ?> </span>
         </div>
       </div>


         <?php if ( has_post_thumbnail() ): ?>
           <div class="post-divider1"></div>
           <div class="post-thumb-img-content post-thumb">
             <figure class="figure">
               <?php the_post_thumbnail( 'large', array( 'class' => 'figure-img img-fluid mx-auto d-block', 'itemprop' => "image" ) ); ?>
               <?php $caption = get_post(get_post_thumbnail_id())->post_excerpt;
                   if(!empty($caption)):
                ?>
               <figcaption class="mx-1  caption small text-default-aw" itemprop='caption'> <?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?> </figcaption>
             <?php endif; ?>
             </figure>
           </div><!-- .post-thumbnail -->
         <?php endif; ?>
         <hr class="hr-primary1 mt-1 mb-5">
       </header><!-- .entry-header -->
     </div>
   </div><!-- close row -->
<?php }
