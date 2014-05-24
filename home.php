<?php
/**
 * Homepage
 *
 *
 * @package Baking Brew
 */

get_header(); ?>


<article class="main-recipe">
	<div class="main-recipe-img">
		<img src="http://www.poop.bakingbrew.com/baked-goods/uploads/2014/05/IMG_20140426_154227.jpg" alt="Feature Article Image">
	</div>
	<div class="main-recipe-block">
		<h5>Lorem Ipsum</h5>
		<div class="cellar-info-module">Beer | Brewer</div>
	</div>
</article>	

<article class="recent-recipe">
	<div class="recent-recipe-block">
		<div class="recent-recipe-article">
			<h5>Bacon ipsum dolor sit amet meatball rump tri-tip</h5>
			<div class="cellar-info-module">Beer | Brewer</div>
		</div>
		<div class="recent-recipe-img">
			<img src="http://www.poop.bakingbrew.com/baked-goods/uploads/2014/05/IMG_20140426_154227.jpg" alt="Feature Article Image">
		</div>
	</div>


	<div class="recent-recipe-block">
		<div class="recent-recipe-article">
			<h5>Bacon ipsum dolor sit amet meatball rump tri-tip</h5>
			<div class="cellar-info-module">Beer | Brewer</div>
		</div>
		<div class="recent-recipe-img">
			<img src="http://www.poop.bakingbrew.com/baked-goods/uploads/2014/05/IMG_20140426_154227.jpg" alt="Feature Article Image">
		</div>
	</div>

	<div class="recent-recipe-block">
		<div class="recent-recipe-article">
			<h5>Bacon ipsum dolor sit amet meatball rump tri-tip</h5>
			<div class="cellar-info-module">Beer | Brewer</div>
		</div>
		<div class="recent-recipe-img">
			<img src="http://www.poop.bakingbrew.com/baked-goods/uploads/2014/05/IMG_20140426_154227.jpg" alt="Feature Article Image">
		</div>
	</div>

</article><!--recent-recipe-->

<div class="home-cellar">
	<h1>The Cellar</h1>
	<div class="home-cellar-slider">
		<div class="content">
	        <div class="page"></div>
	        <div class="page" style="color;blue;"></div>
	        <div class="page"></div>
	        <div class="page"></div>
		</div>
	</div>
</div>





<script type="text/javascript">
	$(function() {
		$('home-cellar-slide-block').pagesSliderTouch();
	});
</script>

<?php get_footer(); ?>
