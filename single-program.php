
<?php
get_header();
while (have_posts()){the_post(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php the_title(); ?></h1>
            <div class="page-banner__intro">
                <p>This is a content Program Post Type</p>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program')?>"><i class="fa fa-home" aria-hidden="true"></i> Program page</a> <span class="metabox__main"> <?php the_title(); ?> </span></p>
        </div>
        <div class="generic-content"><?php the_content(); ?></div>

        <?php
        $today=date('Ymd');
        $args=array(
            'post_type'=>'events',
            'posts_per_page'=> 2,
            'meta_key'=>'events_date',
            'orderby'=>'meta_value_num',
            'order'=>'DESC',
            'meta_query'=>array(
                array(
                    'key'=>'events_date' ,
                    'compare'=>'<='  ,
                    'value'=>$today,
                    'type'=>'numeric'

                ),
                array(
                    'key'=>'related_program',
                    'compare'=>'LIKE',
                    'value'=>'"'.get_the_ID().'"'
                )
            )
        );
        //order ASC DESC
        // orderby option post_date .title.rand,meta_value_num(meta_key->namecoustom field required)
        $homeEvent=new WP_Query($args);
        if ($homeEvent->have_posts()){
            ?>
        <hr class="section-break">
        <h2 class="headline headline--medium">Related <?php the_title() ?> Event</h2>
            <?php
        while ($homeEvent->have_posts()){ $homeEvent->the_post(); ?>

            <div class="event-summary">
                <a class="event-summary__date t-center" href="<?php the_permalink() ?>">
                            <span class="event-summary__month">
                            <?php
                            $argTime=(string)get_field('events_date');
                            $EventDateIdeal=new DateTime($argTime);
                            echo $EventDateIdeal->format('M');
                            ?>

                            </span>
                    <span class="event-summary__day"><?php echo $EventDateIdeal->format('d'); ?></span>
                </a>
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                    <p><?php echo wp_trim_words(get_the_content(),10); ?> <a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
                </div>
            </div>


        <?php } wp_reset_postdata(); ?>
<?php } ?>

    </div>
    <?php
}
get_footer();
?>