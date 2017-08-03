<?php
/*
Template Name: Full width for SpreadShop integration.
The element with the id "myShop" is the container for the shop. Do not delete it. You can change it, when also changing the file in js/spreadshop_config.js changing the baseId.
*/
wp_enqueue_style('spreadShopOptionsStyle', plugins_url('style/style.css', __FILE__));
get_header();
?>

    <div id="primary" class="content-area" >
        <main id="main" class="site-main" style="padding-top:<?php echo get_option('spreadshopOffsetTop') ?>px  !important">
            <div id="myShop"></div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_footer(); ?>