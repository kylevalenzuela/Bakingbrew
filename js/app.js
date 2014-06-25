//adding .touch .no-touch classes
document.documentElement.className +=
    (("ontouchstart" in document.documentElement) ? ' touch' : ' no-touch');

$('').click(function(){
        $.ajax('recent-popular-post.php', {
            url: this.href,
            type: 'GET',
            dataType: 'html',
            success: function (data) {
                $('#container').html(data);
            }
        });
    });
