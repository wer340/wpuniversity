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
  'post_type'=>array('post','page','campus','events','program','professor'),
    //s lowercase search
    's'=>sanitize_text_field($data['term'])
);
//create sub array for categorize result search
    $Result=array(
        'general_inf'=>array(),
        'campuses'=>array(),
        'events'=>array(),
        'programs'=>array(),
        'professors'=>array()
    );
    $resultQuery=new WP_Query($arg);
        while ($resultQuery->have_posts()){
            $resultQuery->the_post();
            $type=get_post_type();
            switch ($type){
                case 'post'|'page' :
                    array_push($Result['general_inf'],array(
                        'title'=>get_the_title(),
                        'permalink'=>get_the_permalink()


                    ));

                break;
                case 'events':
                    array_push($Result['events'],array(
                        'title'=>get_the_title(),
                        'permalink'=>get_the_permalink(),

                    ));

                break;
                case 'campus':
                    array_push($Result['campuses'],array(
                        'title'=>get_the_title(),
                        'permalink'=>get_the_permalink(),


                    ));

                break;
                case 'program':
                    array_push($Result['programs'],array(
                        'title'=>get_the_title(),
                        'permalink'=>get_the_permalink(),


                    ));

                break;
                case 'professor':
                    array_push($Result['professors'],array(
                        'title'=>get_the_title(),
                        'permalink'=>get_the_permalink(),


                    ));

                break;
            }

        }
        return $Result;
}