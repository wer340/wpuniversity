
<?php
get_header();
while (have_posts()){the_post();pageBannerHandle(); ?>



    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus')?>"><i class="fa fa-home" aria-hidden="true"></i> campus page</a> <span class="metabox__main"> <?php the_title(); ?> </span></p>
        </div>
        <div class="generic-content"><?php the_content(); ?></div>
   $args=array(
    'post_type'=>'professor',
    'posts_per_page'=> -1,
    'orderby'=>'title',
    'order'=>'ASC',
    'meta_query'=>array(
        array(
            'key'=>'related_campus',
            'compare'=>'LIKE',
            'value'=>'"'.get_the_ID().'"'
        )
    )
);
                $homeEvent=new WP_Query($args);
        if ($homeEvent->have_posts()){
            ?>
<!--        <hr class="section-break">-->
<!--        <h2 class="headline headline--medium">Related --><?php //the_title() ?><!-- Professor</h2>-->
<!--            --><?php
//            echo '<ul class="min-list lin-list">';
//        while ($homeEvent->have_posts()){ $homeEvent->the_post(); ?>
<!--<li>-->
<!--             <a class="professor-card" href="--><?php //the_permalink() ?><!--">-->
<!--                 <span class="professor-card__name">--><?php //the_title() ?><!--</span>-->
<!--             </a>-->
<!--        </li>-->
<!---->
<!--        --><?php //} wp_reset_postdata(); ?>
<?php //} ?><!--     -->






        <div class="acf-map">
            <?php
//        $map_location=get_field('map_location');
                ?>
                <div class="marker" data-lng="47.378937" data-lat="8.536292">

                    <?php
                    //     echo   $map_location['address'];
                    //                the_title();
                    //                the_permalink() go single-campus
                    ?>
                </div>

        </div>

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