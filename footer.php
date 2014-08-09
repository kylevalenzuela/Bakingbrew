<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Baking Brew
 */
?>
</div><!-- .page-wrap -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="f-wrap">
			<div class="footer-social">
				<h3>Social</h3>
				<ul class="social-list">
					<li><a href="https://twitter.com/kylevalenzuela"><span class="icon icon-twitter"></span><span><h6>Twitter<br />@kylevalenzuela</h6></span></a></li>
					<li><a href="https://twitter.com/bakingbrew"><span class="icon icon-twitter"></span><span><h6>Twitter<br />@bakingbrew</h6></span></a></li>
					<li><a href="https://www.facebook.com/bakingbrew"><span class="icon icon-facebook"></span><span><h6>Facebook<br />bakingbrew</h6></span></a></li>
					<li><a href="https://plus.google.com/b/116695932204699760783/116695932204699760783/about"><span class="icon icon-google"></span><span><h6>Google +<br />Baking Brew</h6></span></a></li>
					<li><a href="http://instagram.com/bakingbrew"><span class="icon icon-instagram"></span><span><h6>Instagram<br />bakingbrew</h6></span></a></li>
					<li><a href="https://untappd.com/user/valenzuelakyle"><span class="icon icon-untapppd"></span><span><h6>Untapppd<br />valenzuelakyle</h6></span></a></li>
				</ul>
			</div>
				<?php wp_nav_menu(array(
					'menu'=>'main nav',
					'container'=> 'div',
					'container_class' => 'footer-linkage',
				)); ?>
			<div class="site-info">
				@<?php the_time('Y') ?> Baking Brew is a an awesome website site written and maintained by Kyle Valenzuela using Wordpress.
			</div><!-- .site-info --> 
		</div><!-- .f-wrap --> 
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
