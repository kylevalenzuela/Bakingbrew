<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Baking Brew
 */
?>
	<div id="secondary" class="one-third sidebar" role="complementary">
		
		<div class="sidebar-left"> 
			<aside class="cards ad">
				<a href="<?php echo get_page_link(55); ?>">
				<div class="ad-wrap">
					<div class="bb-ad">
						<?php include('images/bb-ad.svg'); ?>
					</div>
				</div>
				</a>
			</aside>

			<aside class="subcribe-wrap cards">
				<!-- Begin MailChimp Signup Form -->
				<h4>Recipes By Email</h4>
				<div id="mc_embed_signup">
					<form action="//bakingbrew.us8.list-manage.com/subscribe/post?u=263484f9aad05fa6f56173c41&amp;id=0a7ebbee49" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
	
						<div class="mc-field-group">
							<input type="email" value="" name="EMAIL" class="reach-email" id="mce-EMAIL">
						</div>
						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					    <div style="position: absolute; left: -5000px;"><input type="text" name="b_263484f9aad05fa6f56173c41_0a7ebbee49" tabindex="-1" value=""></div>
					    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
					</form>
				</div>
				<!--End mc_embed_signup-->
			</aside>
		</div>
		
		<div class="sidebar-right">
			<aside class="coin-wrap">
				<h4>Bread Tips</h4>
				<div class="coins">
					<a href="dogecoin:DCDXrJqbp6GBC4KSFcQyn6dam6UhJgDvuS">
						<div class="dodgecoin-link">
							<?php include("icons/dodgecoin.svg"); ?>
							<h3>Dogecoin</h3>	
						</div>
					</a>

			 		<a href="bitcoin:1BfFjYKCntc3WbFeXQPsbhFfYz7fztBXTr">
			 			<div  class="bitcoin-link" >
							<h3>Bitcoin</h3>
							<?php include("icons/bitcoin.svg"); ?>
						</div>
					</a>
				</div>
			</aside>

			<aside class="side-posts">
						<h4>More Recipes</h4>
				
				<ul class="sw">
					<li><a class="side-top-toggle" href="">Top</a></li>
					<li><a class="side-recent-toggle" href="">Recent</a></li>
				</ul>
				<div class="post-list">

					<div class="side-post-wrap">
						<?php 
							jm_most_popular();
							most_recent_side(); 
						?>
					</div>
				</div>
			</aside>

		</div>

		
	</div><!-- .one-third -->


<script type="text/javascript">
function submitIt(form) {
var checkEmail = "@.";
var checkStr = form.rm_email.value;
var EmailValid = false;
var EmailAt = false;
var EmailPeriod = false;
var bad = "";
for (i = 0;  i < checkStr.length;  i++)
{
     ch = checkStr.charAt(i);
     for (j = 0;  j < checkEmail.length;  j++)
     {
        if (ch == checkEmail.charAt(j) && ch == "@")
        EmailAt = true;
        if (ch == checkEmail.charAt(j) && ch == ".")
           EmailPeriod = true;
	      if (EmailAt && EmailPeriod)
		          break;
	      if (j == checkEmail.length)
		          break;
	    }
      if (EmailAt && EmailPeriod)
      {
		    EmailValid = true;
		    break;
	    }
}
if (!EmailValid)
{
bad = bad + "\n    Please enter a valid Email Address.";
}
if (bad != "") {alert("Please fill in the following fields:"+bad +"\n"); return (false);}
return (true);
}
</script>
<!--END OF JAVASCRIPT-->