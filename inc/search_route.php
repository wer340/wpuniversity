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
function universitySerachResult($data){
$arg=array(
  'post_type'=>'professor',
    //s lowercase search
    's'=>sanitize_text_field($data['term'])
);
    $professorResult=array();
    $professor=new WP_Query($arg);
        while ($professor->have_posts()){
            $professor->the_post();
            array_push($professorResult,array(
               'title'=>get_the_title(),
               'permalink'=>get_the_permalink(),
                'content'=>get_the_content()

            ));
        }
        return $professorResult;
}