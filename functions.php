<?php

//function universityfile(){
//    wp_enqueue_style('un-style',get_stylesheet_uri());
//}
//
//add_action('wp_enqueue_scripts','universityfile');
require get_theme_file_path('/inc/search_route.php');
function unversity_restapi(){
    //arg1 type postType arg2 name customfield arg3 array assotive
    register_rest_field('post','authorName',array(
            'get_callback'=>function(){return get_the_author();}
    ));
}

add_action('rest_api_init','unversity_restapi');
function pageBannerHandle(array $arg = null)
{
    if (!$arg['title_banner']) {
        $arg['title_banner'] = get_the_title();
    }
    if (!$arg['photo_banner']) {
        if (get_field('banner_background')) {
            $photobag = get_field('banner_background');
            $arg['photo_banner'] = $photobag['sizes']['bannerLandscape'];
        } else {
            $arg['photo_banner'] = get_theme_file_uri('images/ocean.jpg');
        }
    }
    if (!$arg['subtitle_banner']) {
        $arg['subtitle_banner'] = get_field('banner_title');
    }
?>
     <div class="page-banner">
        <div class="page-banner__bg-image"
             style="background-image: url(<?php  echo $arg['photo_banner']  ?>);">

        </div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $arg['title_banner']; ?></h1>
<div class="page-banner__intro">
    <p><?php echo  $arg['subtitle_banner'];?>  </p>
</div>
</div>
</div>

<?php
        }
function university_files() {
    //arg location arg2 dependency arg3 version arg4 befor tag body
    wp_enqueue_script('googleMap','https://maps.googleapis.com/maps/api/js?key=AIzaSyC7yjGHByjlDNAy5wwU5Sj-9d-UFJW8nkc',null,microtime(),true);
    wp_enqueue_script('jsbundle',get_theme_file_uri('/js/scripts-bundled.js'),null,microtime(),true);

    wp_enqueue_style('nickname-google-idelname', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('nickname-ideal', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_stylesheet_uri(),null,microtime());
    wp_localize_script('jsbundle','main_var',array(
       'root_site'=>get_site_url()
    ));
}
//microtime() put   reason disable cashing
add_action('wp_enqueue_scripts', 'university_files');
function addTiltle(){

    add_theme_support('title-tag');//for title tab on link site
    add_theme_support('post-thumbnails');//display thumbnail this admin panel
    add_image_size('professorLandscape',460,260,true);//first arg name ideal for call second arg width third arg tall forth arg for allow Crop image by respect ratio
    add_image_size('professorPortrait',450,650,true);//notice crop ideal position replace true value put array('left','top') default is center
    add_image_size('bannerLandscape',1500,400,true);
}
add_action('after_setup_theme','addTiltle');


//create posttype event in mu-plogins(must used plugins) in deg that plugin and theme folder is there
//create a php file and name ideal selfown and code paste   no need with include require ,...
//in this method with change theme or deactiveate plugin those(posttype) no collapse
function event_unvirsit_order($query){
    if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query() ){
//        $query->set('posts_per_page',3);
        $query->set('posts_per_page',-1);
        $query->set('orderby','title');
        $query->set('order','ASC');

    }
    $today=date('Ymd');
    if(!is_admin() AND is_post_type_archive('events') AND $query->is_main_query() ){
//        $query->set('posts_per_page',3);
        $query->set('meta_key','events_date');
        $query->set('orderby','meta_value_num');
        $query->set('order','ASC');
        $query->set('meta_query',array(
            array(
                'key'=>'events_date' ,
                'compare'=>'>='  ,
                'value'=>$today,
                'type'=>'numeric'

            )
        ));
    }
}
add_action('pre_get_posts','event_unvirsit_order');

function campus_location($api){
//    AIzaSyC7yjGHByjlDNAy5wwU5Sj-9d-UFJW8nkc
    $api_key='AIzaSyC7yjGHByjlDNAy5wwU5Sj-9d-UFJW8nkc';
    $api['key']=$api_key;
    return $api;
}
// no display dashborb for subcriber user
add_action('admin_init','redirectSubcribToindex');
function redirectSubcribToindex(){
    $userCurrent=wp_get_current_user();
    if (count($userCurrent->roles)==1 AND $userCurrent->roles[0]=='subscriber'){
wp_redirect(site_url('/'));
exit;
    }
}
add_action('wp_loaded','noAppearAminTab');
function noAppearAminTab(){
    $userCurrent=wp_get_current_user();
    if (count($userCurrent->roles)==1 AND $userCurrent->roles[0]=='subscriber'){
        show_admin_bar(false);
    }
}

//add_filter('acf/fields/google_map/api','campus_location');