<?php
	/*
		Template Name: Cellar Brewery Page
	*/
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>



<div id="content" class="page-wrap">

<div class="two-thirds">

	<header id="post-<?php the_ID(); ?>" class="entry-header-blog mat-card">
		<?php cellarroll_brew_img_main(); ?>
		<div class="entry-brew-title-cellar"><h1><?php include("icons/wheat-brew.svg"); ?><?php the_title(); ?><?php include("icons/wheat-brew-r.svg"); ?></h1></div>
		<?php brewery_meta_info(); ?>
	</header>
	<div class="bread-module">
		<span class="likes"><?php echo getPostLikeLink( get_the_ID() ); ?></span>
	</div> <!--Bread Module-->

	

	<div class="entry-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->

	<div class="reciperoll-title cards">
		<h2><?php include('icons/wheat-brew.svg'); ?><?php the_title(); ?> Recipes <?php include('icons/wheat-brew-r.svg'); ?></h2>
	</div>

	<div class="cards"> <?php cellar_loop(); ?></div>

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