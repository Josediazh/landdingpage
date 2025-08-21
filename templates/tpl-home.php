<?php
/*
* Template Name: Home
*/
get_header();

$args_gallery = array(
    'post_type' => 'galeria',
    'order' => 'ASC'

);
$query_gallery = new WP_Query($args_gallery);

$video = get_post_meta(get_the_ID(), 'video', true);
$unlocktext=get_post_meta(get_the_ID(), 'unlocktext', true);
$whytext=get_post_meta(get_the_ID(), 'whytext', true);
$whatunlock=get_post_meta(get_the_ID(), 'whatunlock', true);

$args_testimonial = array(
    'post_type' => 'testimonial',
    'order' => 'ASC'

);
$query_testimonial = new WP_Query($args_testimonial);

?>
<div class="home">
    <section class="portada">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        endif;
        ?>
        <video controls src="<?php echo $video; ?>"></video>
        <div class="btnapply"><a target="_blank" href="http://localhost/landingpage/?fluent-form=3">Apply today</a></div>
    </section>
    <section class="gallerysec">
        <h3>TRUE STORIES.</h3>
        <h3>POWERFULE CHANGES.</h3>
        <h3 class="blue">REAL RESULTS.</h3>
        <div class="gallerycontainer grid-x">
        <?php
        if($query_gallery->have_posts()):
            while ($query_gallery->have_posts()) : $query_gallery->the_post();
                $imagedesctada = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                //$img_after=json_decode(get_post_meta($post->ID, 'img_after', true));
            ?>
                <div class="cell large-6 item text-center">
                    <div class="contentimg"><img src="<?php echo $imagedesctada[0]; ?>" alt=""></div>
                </div>
        <?php endwhile; endif; ?>
        </div>
    </section>
    <section class="unlock">
        <div class="content grid-x">
            <?php echo do_shortcode(wpautop($unlocktext)); ?>
        </div>
        <div class="content grid-x">
            <div class="cell large-3 block">
                <img src="<?php echo get_template_directory_uri().'/img/banner.jpeg' ?>" alt="">
            </div>
            <div class="cell large-9 block">
                <h1>TRANSFORM YOUR LIFE</h1>
                <h3>FOR GUARANTEED RESULTS</h3>
                <p>Build lifelong habits and unlock your genetic potential at this exclusive member price.</p>
            </div>
        </div>
    </section>
    <section class="why">
        <div class="content grid-x">
            <?php echo do_shortcode(wpautop($whytext)); ?>
        </div>
    </section>
    <section class="whatunlock">
        <div class="content grid-x">
            <?php echo do_shortcode(wpautop($whatunlock)); ?>
        </div>
        <div class="btnapply"><a target="_blank" href="http://localhost/landingpage/?fluent-form=3">Apply today</a></div>
    </section>
    <section class="applytoday">
        <h1>Stop Wasting Time.</h1>
        <h1>Stop Doubting Yourself.</h1>
        <h1>No More Guesswork.</h1>
        <h1>Follow the Path.</h1>
        <h1>Step Into Your God-Given Potential.</h1>
        <h1>Transform Your Life.</h1>
        <div class="btnapply"><a target="_blank" href="http://localhost/landingpage/?fluent-form=3">Apply today</a></div>
    </section>
    <section class="testimonials grid-x">
        <?php
            if($query_testimonial->have_posts()):
                while ($query_testimonial->have_posts()) : $query_testimonial->the_post();
                    $imagedesctada = wp_get_attachment_image_src( get_post_thumbnail_id( $query_testimonial->ID ), 'large' );
        ?>
            <div class="testimonial cell large-4 img text-center">
                <div class="">
                    <a href="<?php echo $imagedesctada[0] ?>"><img src="<?php echo  $imagedesctada[0] ?>" alt=""></a>
                </div>
            </div>
        <?php
        endwhile;
        endif;
        ?>
    </section>
    <section class="readytolife">
        <div class="content grid-x align-middle align-center">
            <div class="cell large-8">
                <h3>Are you ready to commit to your journey?</h3>
                <p>In life, there are those who sit back and let life happen, and those who take charge and create the life they want.At Project 8, we invite you to step into the ring, take ownership, and make the decision to become your best self.Join us, and let's begin your journey to greatness together.</p>
            </div>
            <div class="cell large-4">
                <div class="btnapply"><a target="_blank" href="http://localhost/landingpage/?fluent-form=3">Apply today</a></div>
            </div>
        </div>
    </section>
    <section class="portada">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        endif;
        ?>
        <video controls src="<?php echo $video; ?>"></video>
        <div class="btnapply"><a target="_blank" href="http://localhost/landingpage/?fluent-form=3">Apply today</a></div>
    </section>
</div>


<?php get_footer(); ?>