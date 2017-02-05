jQuery( document ).ready(function( $ ) {
    
    $('#cupss-menu').hide();
    // The logic to toggle menu
        $('.hamburger').click(function(){
            if($(this).hasClass('is-active')){
                $(this).removeClass('is-active');
                $('#cupss-menu').hide();
            }else{
                $(this).addClass('is-active');
                $('#cupss-menu').show();
            }
        });
});