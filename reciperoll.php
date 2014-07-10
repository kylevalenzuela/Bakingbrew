<?php
	/*
		Template Name: Recipe Roll
	*/
get_header(); ?>

<div id="content" class="page-wrap">
	<div class="two-thirds">
	
	<div class="mat-card"> 
		<h2>The Bread</h2>

		<select>
		    <option onClick="window.location = 'http://www.google.com'" >google</option>
		    <option onClick="window.location = 'http://www.stackoverflow.com'">stackoverflow</option>
		</select>
			<div class="reciperoll-wrap">
				
				<?php

				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
				  'posts_per_page' => 18,
				  'paged' => $paged,
				  'post_type'=> 'page',
				  'post_parent'=> 55,
				  'order' => 'DESC'


				);
				query_posts($args); 

				while ( have_posts() ) : the_post(); ?>
						<div class="reciperoll-item">
							<a href="<?php the_permalink(); ?> " />
								<img src="<?php the_field('reciperoll_image'); ?>">	
								<span>
									<h6><?php the_title(); ?></h6>
								</span>
							</a>
						</div>

				<?php endwhile; ?>

			</div><!--reciperoll-wrap-->

			<div class="pagination">
				<?php
						global $wp_query;

						$big = 999999999; // need an unlikely integer
						$translated = __( 'Page', 'mytextdomain' ); // Supply translatable string

						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => $wp_query->max_num_pages,
						        'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
						) );
					wp_reset_query(); ?>
			</div><!--pagination-->
		</div><!--mat-card-->
	</div><!--two-thirds-->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
