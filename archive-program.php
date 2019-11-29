<?php get_header();
pageBannerHandle(array('title_banner'=>'Welcome To Program PostType','subtitle_banner'=>'look for around we are  mature with this course'))

?>

    <div class="container container--narrow page-section">
<ul class="link-list min-list">
        <?php while (have_posts()){  the_post();?>
        <li><a href="<?php the_permalink() ?>"><?php the_title() ?> </a></li>
        <?php } ?>
</ul>
        <?php echo paginate_links() ?>



<?php
get_footer();
?>