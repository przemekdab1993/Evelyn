$(function() {
    var $containerVote = $('.vote-list');

    $containerVote.find('a').on('click', function(e) {
        e.preventDefault();
        var $link = $(e.currentTarget);

        $.ajax({
            url: 'elections/'+$link.data('userId')+'/vote/'+$link.data('direction'),
            method: 'POST'
        }).then(function(data) {
            $containerVote.find('#vote-user-'+data.userId+' .count-vote').text(data.newCount)
        });



    });
});