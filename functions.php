<?php

//function universityfile(){
//    wp_enqueue_style('un-style',get_stylesheet_uri());
//}
//
//add_action('wp_enqueue_scripts','universityfile');

function university_files() {
    wp_enqueue_style('nickname-google-idelname', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('nickname-ideal', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'university_files');