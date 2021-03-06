<?php
/**
 * Outputs the single post content. Displayed by single.php.
 * 
 * @package Simone
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php 
    // Display featured image only if this is a regular post
    if ('post' === get_post_type()){
        if (has_post_thumbnail()) {
            echo '<div class="single-post-thumbnail clear">';
            echo '<div class="image-shifter">';
            simone_the_responsive_thumbnail( get_the_ID() );
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
    
	<header class="entry-header clear">
            
            <?php
                /* translators: used between list items, there is a space after the comma */
                $category_list = get_the_category_list( __( ', ', 'simone' ) );

                if ( simone_categorized_blog() ) {
                    echo '<div class="category-list">' . $category_list . '</div>';
                }
            ?>
            <?php
                
            ?>
		<h1 class="entry-title">
                <?php 
                    the_title(); 
                    if ('review' === get_post_type()){
                        // Echo out the year if this is a review
                        $terms = get_the_terms( $post->ID, 'release_year' );
                        if( $terms && ! is_wp_error( $terms ) ){
                            $term = array_shift($terms);
                            echo ' (' . $term->name . ')';
                        }
                    }
                    ?>
                </h1>

		<div class="entry-meta">
                    <?php simone_posted_on(); ?>
                    <?php 
                    if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
                        echo '<span class="comments-link">';
                        comments_popup_link( __( 'Leave a comment', 'simone' ), __( '1 Comment', 'simone' ), __( '% Comments', 'simone' ) );
                        echo '</span>';
                    }
                    ?>
                    <?php edit_post_link( __( 'Edit', 'simone' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
        
        <div class="entry-content">
                <?php 
                // If the current post is in the Reviews post type, output the review-info.php template content
                if ('review' === get_post_type()){
                    get_template_part('review', 'info'); 
                }
                ?>
            
            <?php echo '//지워~This is the content-single.php template file in the child theme.'; ?> 
            <?php // Regardless, output the full content of the post ?>
		<?php the_content(); ?> 
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'simone' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			echo get_the_tag_list( '<ul><li><i class="fa fa-tag"></i>', '</li><li><i class="fa fa-tag"></i>', '</li></ul>' );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
