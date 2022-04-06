<?php get_header();
the_post(); ?>
<div class="container mt-3 mt-sm-2 mb-3 pt-md-4 pb-sm-4">
    <article class="<?php echo $post->post_status; ?> post-<?php the_ID(); ?> pn-article">
        <header class="entry-header mb-5">
            <div class="row d-flex justify-content-center">

                <div class="col-md-12">
                    <div class="post-date font-italic"> <?php $post_date = get_the_date('M j, Y');
                                              echo esc_html($post_date); ?></div>
                    <div class="post-title">
                        <?php the_title('<h1 class="post-title mb-3">', '</h1>'); ?>
                        <?php $subheading = get_field('article_sub_heading'); ?>
                        <?php if ($subheading) : ?>
                    </div>
                    <div class="post-excerpt lead">
                        <p><?php echo $subheading; ?> </p>
                    </div>
                    <?php endif; ?>

                    <?php $author = get_field('article_author'); ?>
                    <?php if ($author) : ?>
                    <div class="post-author font-italic small"> By: <?php echo $author; ?></div>
                    <?php endif; ?>
                    <div class="spacer mb-4"> </div>

                    <?php if (has_post_thumbnail()) : ?>
                    <?php $thumb = get_the_post_thumbnail_url('', 'aawwp-newsroom-article-full'); ?>
                    <?php $alt = get_post_meta('', '_wp_attachment_image_alt', true); ?>
                    <div class="post-thumbnail ">
                        <div class="pn-article-image"><img src="<?php echo esc_url($thumb); ?>"
                                class="img-fluid rounded  mx-auto d-block" alt="<?php echo esc_attr($alt); ?>" /></div>
                        <div class="caption text-default-aw"><?php the_post_thumbnail_caption(); ?></div>
                    </div><!-- .post-thumbnail -->
                    <?php endif; ?>
                </div>
            </div>

        </header><!-- .entry-header -->
        <div class="row justify-content-center">
            <div class="col-11 col-md-8">
                <div class="entry-content" itemprop="articleBody">
                    <?php the_content(); ?>
                </div>
                <footer class="entry-footer mt-4 pb-5 row divider">
                    <div class="post-tags  col-12">

                        <?php
                        //Get related post by category

            $catArray = get_the_terms(get_the_ID(), 'category'); 
            $academicArray = get_the_terms(get_the_ID(), 'academic_units');
            $termMerge = array();

            if (!empty($catArray) && !empty($academicArray)) {
              $termMerge =  array_merge($catArray,  $academicArray);
            } elseif (!empty($catArray)) {
              $termMerge =  $catArray;
            } elseif (!empty($academicArray)) {
              $termMerge =   $academicArray;
            }

            if ($termMerge) : ?>
                        <div><strong>Tags:</strong></div>
                        <?php
              foreach ($termMerge as $term) {
                $term_link = get_term_link($term); ?>

                        <a href="<?php echo esc_url($term_link) ?>"
                            class="term-link btn btn-secondary btn-sm my-1 mr-2"><?php echo $term->name ?></a>

                        <?php
              }

            endif;
            ?>
                </footer>
            </div>
        </div>
    </article>
    <?php if (is_singular()) : ?>
    <section class="trending-news mt-3 pt-5 mb-5">
        <div class="container">
            <?php //Get related post by category ?>
            <?php $categories = get_the_category($post->ID); ?>
            <?php if ($categories) : ?>
            <?php $category_ids = array(); ?>
            <?php foreach ($categories as $individual_category) : ?>
            <?php $category_ids[] = $individual_category->term_id; ?>
            <?php endforeach; ?>
            <?php $args = array(
            'category__in' => $category_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page' => 3,
            'ignore_sticky_posts' => 1,
            'oderby' => 'rand'
          ); ?>
            <?php $my_query = new WP_Query($args); ?>
            <?php if ($my_query->have_posts()) : ?>

            <h2 class="ucf-related-article">You Might Also Like</h2>

            <div class="row">
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <div class="col-md-4">

                    <a href="<?php the_permalink() ?>"
                        class="related-thumb"><?php the_post_thumbnail('aawwp-newsroom-md-article', array('class'  => 'img-fluid mb-3 rounded')); ?></a>
                    <h3 class="title-like h5"><a href="<?php the_permalink() ?>"
                            class="text-secondary"><?php the_title(); ?></a></h3>

                </div>
                <?php endwhile; ?>
            </div>


            <?php endif; ?>
            <?php wp_reset_query(); ?>
            <?php endif; ?>

        </div>
    </section>

    <?php endif; ?>
</div>

<?php get_footer();