<!DOCTYPE html>
<html lang="en-us">

<head>
    <?php wp_head(); ?>
</head>

<body ontouchstart <?php body_class(); ?>>
    <?php do_action('website_before'); ?>
    <a class="skip-navigation bg-complementary text-inverse box-shadow-soft" href="#content">Skip to main content</a>
    <div id="ucfhb"></div>
    <header class="site-header">
        <?php if ( ! $exclude_nav ) { echo ucfwp_get_nav_markup( false ); } ?>
        <?php echo ucfwp_get_header_markup(); ?>
    </header>
    <main class="site-main">
        <?php echo ucfwp_get_subnav_markup(); ?>
        <div class="site-content" id="content" tabindex="-1">

            <?php
