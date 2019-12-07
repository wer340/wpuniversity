
<?php
get_header();
pageBannerHandle(
        array('title_banner'=> 'search Result',
            'subtitle_banner'=>'you searched for &ldquo;'. esc_html(get_search_query(false)).'&rdquo;')
);
?> <div class="container container--narrow page-section">
<?php
if(have_posts()){
while (have_posts()){
the_post();

get_template_part('template-parts/content', get_post_type());




?>


<?php
}
echo paginate_links();
?>
</div>
    <?php
}

else{
    echo "<h1 class='headline headline--small'>NOT found result for &ldquo;".esc_html(get_search_query(false))."&rdquo;</h1>";
}
get_footer();
?>