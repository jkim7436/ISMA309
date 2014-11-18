<?php
/*show post/review/textimonial on 'Home' page*/
function my_add_reviews( $query ) {
    if ( ! is_admin() && $query->is_main_query() ){
        if ($query->is_home() || $query->is_search() ) {
        $query->set( 'post_type', array( 'post', 'review', 'testimonial' ) );
        }
    }
}

add_action( 'pre_get_posts', 'my_add_reviews' );
/*pre_get_posts: before you go to database I want to change.*/

/*new function for fonts*/
function ISMA309_google_fonts(){
    wp_enqueue_style('PT_Sans','http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic');
}
add_action('wp_enqueue_scripts','ISMA309_google_fonts');