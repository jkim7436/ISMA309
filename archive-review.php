<?php
/**
 * The main index file for the Reviews post type. 
 * Powered by isotope
 */

get_header(); ?>

	<div id="primary" >
        
        <nav class="filter-boxes">
                <div class="tax-stack">
                    <h3 class="filter-title">Year of Release</h3>
                    <div class = "option-set">
                        <ul>
                        <?php
                        $terms = get_terms( 'release_year', array( 'hide_empty' => true ) );
                        
                        if (!empty( $terms ) && !is_wp_error( $terms ) ){
                            foreach( $terms as $term){ ?>
                                <li>
                                    <input type="checkbox" value=".<?php echo $term->slug; ?>" id="<?php echo $term->slug; ?>" />
                                    <label for="<?php echo $term->slug; ?>"><?php  echo $term->name; ?></label>
                                </li>
                            <?php
                            }
                        }
                        ?>   
                        </ul>
                    </div>
                    <h3 class="filter-title">Rating</h3>
                    <div class = "option-set">
                        <ul>
                        <?php
                        $terms = get_terms( 'rating', array( 'hide_empty' => true ) );
                        
                        if (!empty( $terms ) && !is_wp_error( $terms ) ){
                            foreach( $terms as $term){ ?>
                                <li>
                                    <input type="checkbox" value=".<?php echo $term->slug; ?>" id="<?php echo $term->slug; ?>" />
                                    <label for="<?php echo $term->slug; ?>"><?php  echo $term->name; ?></label>
                                </li>
                            <?php
                            }
                        }
                        ?>   
                        </ul>
                    </div>   
                    <h3 class="filter-title">Features</h3>
                    <div class = "option-set">
                        <ul>
                        <?php
                        $terms = get_terms( 'feature', array( 'hide_empty' => true ) );
                        
                        if (!empty( $terms ) && !is_wp_error( $terms ) ){
                            foreach( $terms as $term){ ?>
                                <li>
                                    <input type="checkbox" value=".<?php echo $term->slug; ?>" id="<?php echo $term->slug; ?>" />
                                    <label for="<?php echo $term->slug; ?>"><?php  echo $term->name; ?></label>
                                </li>
                            <?php
                            }
                        }
                        ?>   
                        </ul>
                    </div>   
                    <h3 class="filter-title">Mood</h3>
                    <div class = "option-set">
                        <ul>
                        <?php
                        $terms = get_terms( 'mood', array( 'hide_empty' => true ) );
                        
                        if (!empty( $terms ) && !is_wp_error( $terms ) ){
                            foreach( $terms as $term){ ?>
                                <li>
                                    <input type="checkbox" value=".<?php echo $term->slug; ?>" id="<?php echo $term->slug; ?>" />
                                    <label for="<?php echo $term->slug; ?>"><?php  echo $term->name; ?></label>
                                </li>
                            <?php
                            }
                        }
                        ?>   
                        </ul>
                    </div>   
                </div>
            </nav>
        
		<main id="main" class="review-index" role="main">
           
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

                            <?php
                            // Do we have a featured image? If so, display it
                            if (has_post_thumbnail()){
                            ?>
                            <article class="review-item <?php echo custom_taxonomies_terms_links($post->ID); ?>">
                                <figure class="index-poster">
                                    <a href="<?php echo get_the_permalink(); ?>" title="Read the review of <?php echo esc_attr(get_the_title()); ?>">
                                        <?php the_post_thumbnail('poster-single'); ?>
                                    </a>
                                </figure>
                            </article>
                            <?php
                            }
                            ?>

			<?php endwhile; ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
