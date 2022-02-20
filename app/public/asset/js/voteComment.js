$(function() {
    var $containerVote = $('.comment-vote');

    $containerVote.find('a').on('click', function(e) {

        e.preventDefault();
        if(e.currentTarget.disabled === true){
            return;
        }

        e.currentTarget.disabled = true;

        $(e.currentTarget).addClass('active');
        var $link = $(e.currentTarget);

        $.ajax({
            url: '/doc/'+$link.data('comment-id')+'/voteComment',
            method: 'POST',
            data: {'voteType' : $link.data('direction')}
        }).then(function(data) {
            $containerVote.find('span.comment-vote-count#comment-vote-'+$link.data('comment-id')).text(data.countVote);

            e.currentTarget.disabled = false;
            $(e.currentTarget).removeClass('active');
        });
    });
});