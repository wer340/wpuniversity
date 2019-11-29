<?php get_header();
pageBannerHandle(array('title_banner'=>'Welcome To Event PostType','subtitle_banner'=>'We go on un the world'))

?>

    <div class="container container--narrow page-section">

        <?php while (have_posts()){  the_post();
            get_template_part('template-parts/content-event');
        ?>


        <?php } ?>
        <?php echo paginate_links() ?>
        <div>
            <hr class="section-break">
            <p><a href="<?php echo site_url('/past-events')?>">history past-events</a></p>
        </div>
    </div>


<?php
get_footer();
?>