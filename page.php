
<?php
while (have_posts()){the_post();

    ?>

    <h1>I m A PAge </h1>
    <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
    <p><?php the_excerpt() ?></p>
    <p><?php the_content() ?></p>


    <?php
}

?>