<?php
add_action('rest_api_init','universotySearch');

function universotySearch(){
    //arg1=name url  default wordpress wp/v2/
    //arg2 route  posttype profeesor event ..
    //arg3 array  CRUD   GET Post DElet ..

    register_rest_route('universityREST/v1','search',array(
        // key reserve
//        'method'=>'GET',
    // below line code saftly for all web host
        //WP acroname  point to developer in func from core wordpress
      'method'=>WP_REST_Server::READABLE,
        'callback'=>'universitySerachResult'
    ));
}
function universitySerachResult(){
    return "welcome my ";
}