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
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
			</div>
			<div class="site-info">
				@<?php the_time('Y') ?> BakingBrew is a an awesome site built on Wordpress.
			</div><!-- .site-info --> 
		</div><!-- .f-wrap --> 
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
