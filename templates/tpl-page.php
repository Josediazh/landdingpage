<?php
/*
* Template Name: Page
*/
get_header();
?>

<div class="pagetemplate">
    <section class="portada">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        endif;
        ?>
    </section>
</div>
<?php get_footer(); ?>