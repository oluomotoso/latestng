$(document).ready(function($) {

    $(document).on('click','.card__share > a', function(e){
        e.preventDefault() // prevent default action - hash doesn't appear in url
        $(this).parent().find( 'div' ).toggleClass( 'card__social--active' );
        $(this).toggleClass('share-expanded');
    });

});


