<?php


add_image_size( 'poster-single', 350, 539, true );


function my_add_reviews( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ($query->is_home() || $query->is_search() ) {
        $query->set( 'post_type', array( 'post', 'review' ) );
        }
    }
}

add_action( 'pre_get_posts', 'my_add_reviews' );

// Equeue Isotope and isotope settings
function reviews_scripts() {
    if(is_archive('review')){
        wp_enqueue_script( 'isotope-lib', get_stylesheet_directory_uri() . '/js/isotope.min.js', array('jquery'), 11112014, false );
        wp_enqueue_script( 'isotope-settings', get_stylesheet_directory_uri() . '/js/isotope.settings.js', array('isotope-lib'), 11112014, false );
    }
}   

add_action( 'wp_enqueue_scripts', 'reviews_scripts' );


// Output all terms as classes for filtering with Isotope
function custom_taxonomies_terms_links($post_ID){
    // get post by post id
    $post = get_post( $post_ID );
    
    // get post type by post
    $post_type = $post->post_type;
    
    // get post type taxonomies
    $taxonomies = get_object_taxonomies( $post_type, 'objects' );
    
    $out = array();
    
    foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){
    
        // get the terms related to post
        $terms = get_the_terms( $post->ID, $taxonomy_slug );
        
        if ( !empty( $terms ) ) {
            foreach ( $terms as $term ) {
                $out[] = $term->slug;
            }
        }
    }
    
  return implode(' ', $out );
}


// Get the rating number and convert it to ticket icons
function get_rating($post_ID){
    // Get ratings term(s)
    $terms = get_the_terms( $post_ID, 'rating' );
    
    // Check to make sure we actually have rating terms
    if( $terms && ! is_wp_error( $terms ) ){
        // Get just the first term object
        $term = reset($terms);
        // Set the term name (rating number) as the variable $rating
        $rating = $term->name;

        // Output tickets to match the number
        echo '<div class="ratings movie-tax">';
        echo '<h4 class="movie-data-title">Rating</h4>';
        echo '<a href="' . get_term_link( $term->slug, 'rating' ) . '" title="' . get_the_title($post_ID) . ' gets ' . $rating . ' of 5 tickets.">';
        
        // Output one black ticket for each number (3 equals 3 tickets)
        for ($ticket = 0 ; $ticket < $rating; $ticket++){ 
            echo '<i class="fa fa-ticket"></i>'; 
        }
        // Output grey tickets for the remainder (5 - 3 = 2 tickets)
        for ($no_ticket = $rating ; $no_ticket < 5 ; $no_ticket++){
            echo '<i class="fa fa-ticket grey"></i>'; 
        }
        
        echo '</a>';
        echo '</div>';
    } // Endif
}