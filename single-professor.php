<?php
get_header();
while (have_posts()) {
    the_post();
    pageBannerHandle();
    ?>




    <div class="container container--narrow page-section">

            <div class="generic-content">
                <div class="row group">
                    <div class="one-third">
                        <?php the_post_thumbnail('professorPortrait'); ?>



                    </div>
                    <div class="two-thirds">
                        <?php the_content() ?>
                    </div>

                </div>
            </div>



        <?php $related_program = get_field('related_program');
        if ($related_program) {
            ?>
            <hr class="section-break">
            <h3 class="headline headline--medium">Related Program Post</h3>
            <ul class="link-list min-list ">
                <?php

                foreach ($related_program as $item) { ?>
                    <li><a href="<?php echo get_the_permalink($item) ?>">
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