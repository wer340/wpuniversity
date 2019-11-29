<?php get_header();
pageBannerHandle(array('title_banner'=>'This is the Blog Page','subtitle_banner'=>'Review the news Blog Page'));
?>
    <div class="container container--narrow page-section">

        <?php while (have_posts()){  the_post();?>
    <div class="post-item">
        <h2 class="headline headline--medium headline--post-title "><a href="<?php the_permalink() ?>"> <?php the_title() ?></a></h2>
            <div class="metabox">
                <p>posted By <?php the_author_posts_link() ?> on <?php the_time('n.j.y') ?> in <?php echo get_the_category_list(' ,'); ?> </p>
            </div>
        <div class="generic-content">
            <?php the_excerpt() ?>
            <p><a href="<?php the_permalink() ?>" class="btn btn--blue">continue Reading &raquo;</a></p>
        </div>
    </div>


    <?php } ?>
        <?php echo paginate_links() ?>
    </div>


<?php
get_footer();
?>