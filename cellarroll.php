<?php
	/*
		Template Name: Cellar Roll
	*/
get_header(); ?>

<div id="content" class="page-wrap">

	<div class="two-thirds">
				
				<?php cellarroll_loop(); ?> 

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

	</div><!--two-thirds-->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
