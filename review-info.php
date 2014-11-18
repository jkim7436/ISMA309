<?php
/**
 * Template that displays movie info in a box
 * Kicks in on single movie reviews and index pages
 */
?>

<div class="movie-info clear">
    <?php
    // Do we have a featured image? If so, display it
    if (has_post_thumbnail()){
        echo '<figure class="movie-poster">';
        the_post_thumbnail('poster-single');
        echo '</figure>';
    }
    ?>
    <div class="movie-data">
        <div class="movie-tax">
            <?php echo get_the_term_list( $post->ID, 'genre', '<h4 class="movie-data-title">Genre</h4>', ', ', '' ); ?> 
        </div>
        <div class="movie-tax">
            <?php echo get_the_term_list( $post->ID, 'feature', '<h4 class="movie-data-title">Features</h4>', ', ', '' ); ?> 
        </div>
        <div class="movie-tax">
            <?php echo get_the_term_list( $post->ID, 'mood', '<h4 class="movie-data-title">Moods</h4>', ', ', '' ); ?> 
        </div>
        <?php
            // Output rating through function get_rating() found in functions.php
            echo get_rating($post->ID);
        ?>
    </div>
    <div class="short-review">
        <h4 class="movie-data-title">Quick Review</h4>
        <?php the_excerpt(); ?>
    </div>
</div><!-- .movie-info -->

            