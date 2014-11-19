<?php
/**
 * Template shows review info for index pages
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="index-box">
	<header class="entry-header clear">
            <?php
            
                // Display a thumb tack in the top right hand corner if this post is sticky
                if (is_sticky()) {
                    echo '<i class="fa fa-thumb-tack sticky-post"></i>';
                }
            
            ?>
		<h1 class="entry-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                        <?php 
                        the_title();
                        if ('review' === get_post_type()){
                            // Echo out the year if this is a review
                            $terms = get_the_terms( $post->ID, 'release_year' );
                            if( $terms && ! is_wp_error( $terms ) ){
                                $term = array_shift($terms);
                                echo ' (' . $term->name . ')';
                            }
                        }?>
                    </a>
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
                        <?php edit_post_link( __( ' | Edit', 'simone' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->
        
            <div class="entry-content">
                <?php get_template_part('review', 'info'); ?> <!--generate a box on the post page-->
            </div><!-- .entry-content -->
            <footer class="entry-footer continue-reading">
		<?php echo '<a href="' . get_permalink() . '" title="' . __('Read Full Review ', 'simone') . get_the_title() . '" rel="bookmark">' . __('Read Full Review', 'simone') . '<i class="fa fa-arrow-circle-o-right"></i><span class="screen-reader-text"> ' . get_the_title() . '<span></a>'; ?>
            </footer><!-- .entry-footer -->

	
    </div>
</article><!-- #post-## -->
