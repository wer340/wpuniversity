
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

        <div class="create-note">
            <h2 class="headline headline--medium">create new post</h2>
            <input class="new-note-title" placeholder="inter your title" type="text">
            <textarea class="new-note-body" placeholder="enter your description title here......"></textarea>
            <span class="submit-note">create</span>
            <span class="note-limit-message">note limit reach: deleting an existing note to make room for a new note </span>
        </div>
      <ul class="min-list link-list" id="my-note">
        <?php
        $ourQuery=new WP_Query(array(
            'post_type'=>'note',
            'posts_per_page'=>-1,
            'author'=>get_current_user_id()
        ));
        while ($ourQuery->have_posts()){
            $ourQuery->the_post();?>
            <li data-id="<?php the_ID(); ?>">
                <input readonly class="note-title-field" value="<?php echo str_replace('خصوصی:','',esc_attr(get_the_title() )) ?>">
                <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</span>
                <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</span>
                <textarea  class="note-body-field" readonly><?php echo esc_attr( wp_trim_words(get_the_content(),59)) ?></textarea>
                <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i>save</span>
            </li>
  <?php
            }
        ?>
      </ul>
    </div>



<?php }
get_footer();
?>