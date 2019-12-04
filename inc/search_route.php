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

            switch (get_post_type()){
                case 'post':
                    array_push($Result['general_inf'],array(
                        'title'=>get_the_title(),
                        'permalink'=>get_the_permalink(),
                        'type'=>get_post_type(),
                        'authorName'=>get_the_author()


                    ));

                break;
                case 'page' :
                    array_push($Result['general_inf'],array(
                        'title'=>get_the_title(),
                        'permalink'=>get_the_permalink(),
                        'type'=>get_post_type()


                    ));

                    break;
                case 'events':
                    $argTime=(string)get_field('events_date');
                    $EventDateIdeal=new DateTime($argTime);
                    $description=null;
                    if(has_excerpt()){
                        $description=get_the_excerpt();}
                        else
                        {
                        $description=wp_trim_words(get_the_content(),17);
                        }
                    array_push($Result['events'],array(
                        'title'=>get_the_title(),
                        'permalink'=>get_the_permalink(),
                        'type'=>get_post_type(),
                        'month'=>$EventDateIdeal->format('M'),
                        'day'=>$EventDateIdeal->format('d'),
                       'description'=>$description

                    ));

                break;
                case 'campus':
                    array_push($Result['campuses'],array(
                        'title'=>get_the_title(),
                        'permalink'=>get_the_permalink(),
                        'type'=>get_post_type()

                    ));
                break;
                case 'program':
                    array_push($Result['programs'],array(
                        'title'=>get_the_title(),
                        'permalink'=>get_the_permalink(),
                        'type'=>get_post_type()


                    ));

                break;
                case 'professor':
                    array_push($Result['professors'],array(
                        'title'=>get_the_title(),
                        'permalink'=>get_the_permalink(),
                        'type'=>get_post_type(),
                        'img'=>get_the_post_thumbnail_url(0,'professorLandscape')


                    ));

                break;
            }

        }
$professor=new WP_Query(array(
    'post_type'=>'professor',
    'meta_query'=>array(
        array(
        'key'=>'related_program',
        'compare'=>'LIKE',
        'value'=>'"67"'
    ))
));
        while ($professor->have_posts()){
            $professor->the_post();
            array_push($Result['professors'],
                array(
                'title'=>get_the_title(),
                'permalink'=>get_the_permalink(),
                'type'=>get_post_type(),
                'img'=>get_the_post_thumbnail_url(0,'professorLandscape')
                )
            );

        }

        return $Result;
}