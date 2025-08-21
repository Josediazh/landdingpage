<?php
add_action('add_meta_boxes', 'cyb_meta_boxes');
function cyb_meta_boxes()
{
    //add_meta_box('cyb-meta-img-before', __('Imagen antes'), 'cyb_meta_img_before', 'galeria');
    //add_meta_box('cyb-meta-img-after', __('Imagen despues'), 'cyb_meta_img_after', 'galeria');
    add_meta_box('cyb-meta-video', __('Link del video'), 'cyb_meta_video', 'page');
    add_meta_box('cyb-meta-unlocktext', __('Unlocktext'), 'cyb_meta_unlocktext', 'page');
    add_meta_box('cyb-meta-whytext', __('Why text'), 'cyb_meta_whytext', 'page');
    add_meta_box('cyb-meta-whatunlock', __('What you will unlock'), 'cyb_meta_whatunlock', 'page');
}


function cyb_meta_whatunlock(){
    global $post;
    $whatunlock=get_post_meta($_GET['post'], 'whatunlock', true);

    $settingswhatunlock = array('wp_whatunlock' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name'=>'whatunlock' );
    wp_editor(wp_kses_post($whatunlock , ENT_QUOTES, 'UTF-8'), 'whatunlock', $settingswhatunlock);
}


function cyb_meta_whytext(){
    global $post;
    $whytext=get_post_meta($_GET['post'], 'whytext', true);

    $settingswhytext = array('wp_whytext' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name'=>'whytext' );
    wp_editor(wp_kses_post($whytext , ENT_QUOTES, 'UTF-8'), 'whytext', $settingswhytext);
}


function cyb_meta_unlocktext(){
    global $post;
    $unlocktext=get_post_meta($_GET['post'], 'unlocktext', true);

    $settingsunlocktext = array('wp_unlocktext' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name'=>'unlocktext' );
    wp_editor(wp_kses_post($unlocktext , ENT_QUOTES, 'UTF-8'), 'unlocktext', $settingsunlocktext);
}


function cyb_meta_video(){
    global $post;
    $video = get_post_meta($_GET['post'], 'video', true);

    $html = "<label>Link del video </label>";
    $html .= "<input type='text' name='video' value='$video' size='50'>";

    echo $html;
}


function cyb_meta_img_before(){

    global $post;
    $img_before=get_post_meta($_GET['post'], 'img_before', true);

    $html .='<div class="sec">';
    wp_nonce_field(plugin_basename(__FILE__), 'dynamicMeta_noncename2');
    $html .='<div class="img_gal">';
    $html .= "<input style='display:none;' id='image_location_img_before' type='text' name='img_before' value='' size='50'>";
    $html .= '<input data-multiple="false" data-nameseccion="img_before" type="button" class="onetarek-upload-button button" name="wp_custom_attachment" value="Agregar imagen" />';
    $html .= '</div>';
    $html .= '<div class="items_img_before">';
    if(!empty($img_before)){

        $contador = 0;
        foreach(json_decode($img_before) as $img){
            $html .="<div class='gal-img' data-position='".$contador."'><img src='".$img->full."'><a data-seccion='img_before' class='remove_img' name='".$img->name."'>Borrar</a></div>";
            $contador++;
        }

    }
    $html .='<span></span></div><div class="clearfix"></div>';
    $html .= '</div>';

    echo $html;

}

function cyb_meta_img_after(){

    global $post;
    $img_after=get_post_meta($_GET['post'], 'img_after', true);


    $html .='<div class="sec">';
    wp_nonce_field(plugin_basename(__FILE__), 'dynamicMeta_noncename2');
    $html .='<div class="img_gal">';
    $html .= "<input style='display:none;' id='image_location_img_after' type='text' name='img_after' value='$img_after' size='50'>";
    $html .= '<input data-multiple="false" data-nameseccion="img_after" type="button" class="onetarek-upload-button button" name="wp_custom_attachment" value="Agregar imagen" />';
    $html .= '</div>';
    $html .= '<div class="items_img_after">';
    if(!empty($img_after)){

        $contador = 0;
        foreach(json_decode($img_after) as $img){
            $html .="<div class='gal-img' data-position='".$contador."'><img src='".$img->full."'><a data-seccion='img_after' class='remove_img' name='".$img->name."'>Borrar</a></div>";
            $contador++;
        }

    }
    $html .='<span></span></div><div class="clearfix"></div>';
    $html .= '</div>';

    echo $html;

}

add_action( 'save_post', 'dynamic_save_postdata' );
function dynamic_save_postdata($post_id )
{
    if (isset($_POST['img_before'])) {
        update_post_meta($post_id, 'img_before', $_POST['img_before']);
    }

    if (isset($_POST['img_after'])) {
        update_post_meta($post_id, 'img_after', $_POST['img_after']);
    }

    if (isset($_POST['video'])) {
        update_post_meta($post_id, 'video', $_POST['video']);
    }

    if (isset($_POST['unlocktext'])) {
        update_post_meta($post_id, 'unlocktext', $_POST['unlocktext']);
    }

    if (isset($_POST['whytext'])) {
        update_post_meta($post_id, 'whytext', $_POST['whytext']);
    }

    if (isset($_POST['whatunlock'])) {
        update_post_meta($post_id, 'whatunlock', $_POST['whatunlock']);
    }
}