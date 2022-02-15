$(function() {
    var $containerVote = $('.blog-rating');

    $containerVote.find('a').on('click', function(e) {

        e.preventDefault();
        if(e.currentTarget.disabled === true){
            return;
        }

        e.currentTarget.disabled = true;

        $(e.currentTarget).addClass('active');
        var $link = $(e.currentTarget);

        $.ajax({
            url: '/doc/'+$link.data('doc-id')+'/vote',
            method: 'POST',
            data: {'ratingType' : $link.data('direction')}
        }).then(function(data) {
            $containerVote.find('span.rating-good').text(data.good);
            $containerVote.find('span.rating-bad').text(data.bad);

            e.target.disabled = false;
            $(e.currentTarget).removeClass('active');
        });
    });
});