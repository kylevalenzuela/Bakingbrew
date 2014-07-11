<?php
	/*
		Template Name: Recipe Roll - Top Daily 
	*/
get_header(); ?>

<div id="content" class="page-wrap">
	<div class="two-thirds">
	
	<div class="mat-card"> 
		<h2>The Bread</h2>

			<?php dropdown_menu(); ?>

			<div class="reciperoll-wrap">
				
				<?php
					global $post;
				    $today = "date('j')";
				    $year = "date('Y')";
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = array(
						'posts_per_page' => 18,
					  	'paged' => $paged,
					 	'post_type'=> 'page',
						'post_parent'=> 55,
						'year' => $year,
				        'day' => $today,
				        'meta_key' => '_post_like_count',
				        'orderby' => 'meta_value_num',
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
