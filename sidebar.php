<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Baking Brew
 */

?>
	<div id="secondary" class="one-third sidebar" role="complementary">
	
		<aside class="coin-wrap">
			<h2>Bread Tips</h2>
			<div class="coins">
				<a href="dogecoin:DMq3PvhUz6b483fZCpxN3gnHXoaC8yEPUT">
					<div class="dodgecoin-link">
						<?php include("icons/dodgecoin.svg"); ?>
						<h3>Dogecoin</h3>	
					</div>
				</a>

		 		<a href="bitcoin:1LccD3KqehoUNX6srKYms1YiVk8q1jFcgR">
		 			<div  class="bitcoin-link" >
						<h3>Bitcoin</h3>
						<?php include("icons/bitcoin.svg"); ?>
					</div>
				</a>
			</div>
		</aside>

		<aside class="subcribe-wrap">

			<!--START OF REACHMAIL FORM, CUT FROM HERE DOWN-->

			<form name="signup" method="post" onSubmit="return submitIt(this);" action="https://go.reachmail.net/libraries/form_wizard/process_subscribe.asp" >
			Email address<br />
			<div class="sub-wrap">
				<input type="text" id="rm_email" class="reach-email" name="rm_email" />
				<input type="hidden" name="my_type" value="3" />
				<input type="hidden" name="form_id" value="8042">
				<input type="hidden" name="list_name" value="XLIST_9AD53139E02F435593C4CC9A9058DF38">
				<input type="hidden" name="list_id" value="544351">
				<input type="hidden" name="el_list" value="email">
				<input type="hidden" name="page_confirm" value="http://www.poop.bakingbrew.com/the-bread/taco-bell-sucks-your-face-off/">
				<input type="hidden" name="list_fromname" value="">
				<input type="hidden" name="list_fromemail" value="">
				<input type="hidden" name="list_subject" value="">
				<input class="reach-submit" type="submit" name="Submit" value="Submit" >
			</div>
			</form>
			<!--REACHMAIL FORM ENDS HERE-->
		</aside>

		<aside class="side-posts">
			<ul>
				<li><a href="">Top</a></li>
				<li><a href="">Recent</a></li>
			</ul>
			<ul class="post-list">
				<?php jm_most_popular();?>
			</ul>
		</aside>
		
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