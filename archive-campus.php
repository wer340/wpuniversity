<?php get_header();
pageBannerHandle(array('title_banner'=>'Welcome To Campus PostType','subtitle_banner'=>'push you if not follow me oh dear!'))

?>

    <div class="container container--narrow page-section">
    <div class="acf-map">
        <?php while (have_posts()){  the_post();
//        $map_location=get_field('map_location');
        ?>
            <div class="marker" data-lng="47.378937" data-lat="8.536292">

                <?php
                //     echo   $map_location['address'];
//                the_title();
//                the_permalink() go single-campus
                ?>
            </div>
        <?php } ?>
    </div>




<?php
echo strlen('AIzaSyC7yjGHByjlDNAy5wwU5Sj');
echo '<br>'.strlen('AIzaSyC7yjGHByjlDNAy5wwU5Sj-9d-UFJW8nkc');
get_footer();
?>