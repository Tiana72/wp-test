( function( $ ) {

	//Обновить цвет ссылок в режиме реального времени ...
	wp.customize( 'test_link_color', function( value ) {
		value.bind( function( newval ) {
			$('a').css('color', newval );
		} );
    } );
    
	//Обновляем телефон ...
	wp.customize( 'test_phone', function( value ) {
		value.bind( function( newval ) {
			$('.test-phone span').text( newval );
		} );
    } );
    
    //Показать телефон ...
    wp.customize( 'test_show_phone', function( value ) {
        value.bind( function( newval ) {
            false === newval ? $('.test-phone').fadeOut() : $('.test_phone').fadeIn();
        } );
    } );
    
} )( jQuery );
