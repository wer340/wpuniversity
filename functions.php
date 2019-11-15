<?php

//function universityfile(){
//    wp_enqueue_style('un-style',get_stylesheet_uri());
//}
//
//add_action('wp_enqueue_scripts','universityfile');

function university_files() {
    //arg location arg2 dependency arg3 version arg4 befor tag body
    wp_enqueue_script('jsbundle',get_theme_file_uri('/js/scripts-bundled.js'),null,microtime(),true);
    wp_enqueue_style('nickname-google-idelname', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('nickname-ideal', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_stylesheet_uri(),null,microtime());
}
//microtime() put   reason disable cashing
add_action('wp_enqueue_scripts', 'university_files');
function addTiltle(){
    add_theme_support('title-tag');
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