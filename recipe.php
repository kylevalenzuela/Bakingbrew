<?php
	/*
		Template Name: Recipe Page
	*/
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header" style="background: url('<?php the_field('headerimage'); ?>') no-repeat center center;">
		<div class="head-wrapper">
			<div class="bread-module">
				<?php include("icons/uE001-flatbread.svg"); ?>
				<span class="likes"><?php echo getPostLikeLink( get_the_ID() ); ?></span>
			</div> <!--Bread Module-->
			<h3 class="entry-title"><?php the_title(); ?></h3>
		</div>
	</header>

<div id="content" class="page-wrap">

<div class="two-thirds">
			<div class="entry-content">

				<?php the_content(); ?>
				
			</div><!-- .entry-content -->
			
			<div class="recipe-content"> 
				<h3>The Fixins'</h3>
				<ul>
					<li>3/4 Cups of Flour</li>
					<li>3/4 Cups of Flour</li>

				</ul>
			</div><!-- .recipe-content -->

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

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