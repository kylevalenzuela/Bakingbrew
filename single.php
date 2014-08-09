<?php
	/*
		Template Name: Blog Post
	*/
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>




<div id="content" class="page-wrap">

	<div class="two-thirds">
	<header id="post-<?php the_ID(); ?>" class="entry-header-blog cards">
		<h3><?php the_title(); ?></h3>
		<div class="time-stamp">
			<?php echo "Posted: <time>" . human_time_diff(get_the_time('U'), current_time('timestamp')) . "</time> ago"; ?>
		</div>
	</header>
				<div class="entry-content">

					<?php the_content(); ?>
					<?php share_buttons(); ?>
				</div><!-- .entry-content -->
				

				<!-- comments -->

					
					<div id="disqus_thread" class="disqus_thread">
						 <div id="disqus_loader" >
							<button class="disqus-button" onclick='
							  jQuery.ajaxSetup({cache:true});
							  jQuery.getScript("http://Bakingbrew.disqus.com/embed.js");
							  jQuery.ajaxSetup({cache:false});
							  jQuery("#disqus_loader").remove();
							'>
								Post a Comment
							</button>
					</div>
					</div>

		<?php endwhile; // end of the loop. ?>
	
	</div><!--two-thirds-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>

<script type="text/javascript">
	jQuery(document).ready(function() {
	jQuery('body').on('click','.jm-post-like',function(event){
		event.preventDefault();
		heart = jQuery(this);
		post_id = heart.data("post_id");
		heart.html("<i class='fa fa-heart'></i>&nbsp;<i class='fa fa-cog fa-spin'></i>");
		jQuery.ajax({
			type: "post",
			url: ajax_var.url,
			data: "action=jm-post-like&nonce="+ajax_var.nonce+"&jm_post_like=&post_id="+post_id,
			success: function(count){
				if( count.indexOf( "already" ) !== -1 )
				{
					var lecount = count.replace("already","");
					if (lecount == 0)
					{
						var lecount = "Like";
					}
					heart.prop('title', 'Like');
					heart.removeClass("liked");
					heart.html("<i class='fa fa-heart-o'></i>&nbsp;"+lecount);
				}
				else
				{
					heart.prop('title', 'Unlike');
					heart.addClass("liked");
					heart.html("<i class='fa fa-heart'></i>&nbsp;"+count);
					}
				}
			});
		});
	});
</script>