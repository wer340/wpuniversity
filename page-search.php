
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
        <?php
        $the_id=wp_get_post_parent_id(get_the_ID());
        if($the_id) {?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p><a class="metabox__blog-home-link" href="<?php echo get_the_permalink($the_id)?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($the_id) ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
            </div>
        <?php } ?>
        <?php

        if($the_id){
            $findChildOf=$the_id;
        }else{
            $findChildOf=get_the_ID();
        }
        ?>




        <?php
        $testarray=get_pages(array('child_of'=>$findChildOf));
        if($the_id or $testarray ) { ?>
            <div class="page-links">
                <h2 class="page-links__title"><a href="<?php echo get_the_permalink($findChildOf)?>"><?php echo get_the_title($findChildOf) ?></a></h2>
                <ul class="min-list">
                    <?php wp_list_pages(array(//associative array
                        'title_li'=>null,
                        'child_of'=>$findChildOf
                    )) ?>
                </ul>
            </div>
        <?php } ?>
        <div class="generic-content">
         <?php get_search_form() ;
//         recive form from searchform.php
         ?>

        </div>

    </div>



<?php }
get_footer();
?>