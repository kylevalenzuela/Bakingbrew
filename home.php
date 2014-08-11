<?php
/**
 * Homepage
 *
 *
 * @package Baking Brew
 */

get_header(); ?>

<div class="page-wrap">
	
<div class="two-thirds">
	
		<div class="mat-card home-blogroll-title">
			<a href="<?php echo get_permalink(128); ?>"><h1><?php include("icons/wheat-brew.svg"); ?>Bread<?php include("icons/wheat-brew-r.svg"); ?></h1></a>
			<h5>Recent Recipes</h5>
		</div>

	<div class="home-top-articles">
		<?php home_most_recent() ?>
		
		<article class="recent-recipe">
			<?php home_sub_recent(); ?>
		</article><!--recent-recipe-->
	</div>
	
	<div class="home-blogroll">
		<div class="mat-card home-blogroll-title">
			<a href="<?php echo get_permalink(33); ?>"><h1><?php include("icons/wheat-brew.svg"); ?>Cellar<?php include("icons/wheat-brew-r.svg"); ?></h1></a>
	    		<h5>Top Breweries</h5>
			<div class="scroll-border">
	    		<h3>swipe</h3>
	    		<div class="scroll-animation"></div>
	 		</div>
		</div>
		
	</div>

	


		<div class="home-cellar-outer-container">
			<div class="home-cellar-container">
				<div class="home-cellar-carousel">

					<?php home_cellar_slide(); ?>
				</div>
			</div>
		</div>

	<div class="home-blogroll">
		<div class="mat-card home-blogroll-title">
			<a href="<?php echo get_permalink(128); ?>"><h1><?php include("icons/wheat-brew.svg"); ?>Blog<?php include("icons/wheat-brew-r.svg"); ?></h1></a>
		</div>
	</div>

		<?php blogroll_query_frontpage(); blogroll_loop(); ?>

</div><!--two-thirds width-->





<?php get_sidebar(); ?>
<?php get_footer(); ?>
