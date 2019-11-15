
<?php
get_header();
while (have_posts()){the_post(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php the_title(); ?></h1>
            <div class="page-banner__intro">
                <p>Dont forget to Replace me later</p>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('events')?>"><i class="fa fa-home" aria-hidden="true"></i> Event page</a> <span class="metabox__main"> <?php the_title(); ?> </span></p>
        </div>
        <div class="generic-content"><?php the_content(); ?></div>


    <?php $related_program=get_field('related_program');
    if($related_program){
?>
  <hr class="section-break">
  <h3 class="headline headline--medium">Related Program Post</h3>
    <ul class="link-list min-list ">
    <?php

    foreach ($related_program as $item) { ?>
       <li ><a href="<?php echo get_the_permalink($item)?>">
        <?php echo get_the_title($item) ?></a></li>

        <?php
    } ?>
    </ul>
        <?php } ?>
        </div>
<?php
}
get_footer();
?>