<?php

//register sidebar
function provost_news_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Frontpage Sidebar' ),
            'id' => 'front-sidebar',
            'description' => __( 'Sidebar for the frontpage' ),
            'before_widget' => '<div class="widget-content mb-5 pb-5 divider">',
            'after_widget' => "</div>",
            'before_title' => '<h2 class="widget-title heading-underline">',
            'after_title' => '</h3>',
        )

    );

    register_sidebar(
        array (
            'name' => __( 'Social' ),
            'id' => 'social_sidebar',
            'description' => __( 'Display social icons on post' ),
            'before_widget' => '<div class="social-content text-right">',
            'after_widget' => "</div>",
            'before_title' => '<div class="">',
            'after_title' => '</div>',
        )

    );

    register_sidebar(
        array (
            'name' => __( 'Provost News' ),
            'id' => 'provost_news',
            'description' => __( 'Display articles from the provost' ),
            'before_widget' => '<div class="social-content">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="h4 divider pb-3 mb-3">',
            'after_title' => '</h3>',
        )

    );
    register_sidebar(
        array (
            'name' => __( 'After Post' ),
            'id' => 'posts-block',
            'description' => __( 'Display the latest new or other articles' ),
            'before_widget' => '<div class="posts-block">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="h4 divider pb-3 mb-3">',
            'after_title' => '</h3>',
        )

    );

}
