
<?php
get_header();
while (have_posts()){the_post();
pageBannerHandle();
?>



    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program')?>"><i class="fa fa-home" aria-hidden="true"></i> Program page</a> <span class="metabox__main"> <?php the_title(); ?> </span></p>
        </div>
        <div class="generic-content"><?php echo get_field('editor_program') ?></div>

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
        while ($homeEvent->have_posts()){ $homeEvent->the_post();
            get_template_part('template-parts/content','event');
        ?>



        <?php } wp_reset_postdata(); ?>
<?php } ?>

<!--        this below custom query professor-->

<?php
$args=array(
    'post_type'=>'professor',
    'posts_per_page'=> -1,
    'orderby'=>'title',
    'order'=>'ASC',
    'meta_query'=>array(
        array(
            'key'=>'related_program',
            'compare'=>'LIKE',
            'value'=>'"'.get_the_ID().'"'
        )
    )
);
                $homeEvent=new WP_Query($args);
        if ($homeEvent->have_posts()){
            ?>
        <hr class="section-break">
        <h2 class="headline headline--medium">Related <?php the_title() ?> Professor</h2>
            <?php
            echo '<ul class="professor-cards">';
        while ($homeEvent->have_posts()){ $homeEvent->the_post(); ?>

         <li class="professor-card__list-item">
             <a class="professor-card" href="<?php the_permalink() ?>">
                 <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>" alt="">
                 <span class="professor-card__name"><?php the_title() ?></span>
             </a>
         </li>


        <?php } wp_reset_postdata(); ?>
<?php } ?>
    </ul>
    </div>
    <?php
}
get_footer();
?>