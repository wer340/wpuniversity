
<?php
get_header();
while (have_posts()){the_post(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title">Past Events</h1>
            <div class="page-banner__intro">
                <p>we would like to surpass from another Develooper</p>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">

       <?php
       $today=date('Ymd');
       $arg=array(
           'paged'=>get_query_var('paged',1),
         'post_type' =>'events',
         'posts_per_page'=>-1,
         'meta_query'=>array(
            array(
                'key'=>'events_date' ,
                'compare'=>'<'  ,
                'value'=>$today,
                'type'=>'numeric'

            )
        )
       );
       $eventPastQuery=new WP_Query($arg);

       while ($eventPastQuery->have_posts()){
           $eventPastQuery->the_post();
           get_template_part('template-parts/content','event');
           ?>



       <?php }  ?>



        <?php echo paginate_links(array('total'=>$eventPastQuery->max_num_pages));?>
    </div>



<?php }
get_footer();
?>