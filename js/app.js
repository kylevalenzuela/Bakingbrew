//adding .touch .no-touch classes
document.documentElement.className +=
    (("ontouchstart" in document.documentElement) ? ' touch' : ' no-touch');

//recent and popular posts function 
function Posts(el) {
  var post = this;
  this.el = el;
  this.loadPosts = function() {
    $.ajax('recent-popular-post.php', {
      data: {posts: post.el.data('posts')},
      context: post,
      success: function(response) {
        this.el.find('.post-toggle').html(response);
      },
      error: function() {
        this.el.find('.post-toggle').html('<li>There was a problem fetching the latest photos. Please try again.</li>');
      },
      timeout: 3000,
      beforeSend: function() {
        this.el.addClass('is-fetching');
      },
      complete: function() {
        this.el.removeClass('is-fetching');
      }
    });
  }
  this.el.on('click', 'button', this.loadPosts);
}
jQuery(document).ready(function() {
  var popular = new Posts($('#popular-posts'));
  var recent = new Posts($('#recent-posts'));
});
