<?php
/**
 * Template Name: Search Page Template
 */
 get_header(); ?>

 <div class="container mt-3 mt-sm-2 mb-3 pb-sm-4">
   <h1 class="page-title mt-5 mb-5"><?php echo esc_html('Search') ?></h1>
   <div class="pt-5 pb-2 px-4" style="background-color: #eceeef;">
     <?php get_search_form(); ?>
   </div>
   
 </div>

 <?php get_footer();
