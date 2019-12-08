
<?php
if(!is_user_logged_in()){
  wp_redirect(esc_url(site_url('/')))  ;
  exit;
}
get_header();
while (have_posts()){the_post(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php the_title(); ?></h1>
            <div class="page-banner__intro">
                <p>there is a all note for yourself</p>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">
      <ul class="min-list link-list" id="my-note">
        <?php
        $ourQuery=new WP_Query(array(
            'post_type'=>'note',
            'posts_per_page'=>-1,
            'author'=>get_the_author(get_current_user_id())
        ));
        while ($ourQuery->have_posts()){
            $ourQuery->the_post();?>
            <li>
                <input class="note-title-field" value="<?php echo esc_attr(wp_trim_words(get_the_title(),3) ) ?>">
                <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span>
                <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span>
                <textarea  class="note-body-field"><?php echo esc_attr( wp_trim_words(get_the_content(),59)) ?></textarea>
            </li>
  <?php
            }
        ?>
      </ul>
    </div>



<?php }
get_footer();
?>