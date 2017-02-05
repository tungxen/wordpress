( function( $ ) {

  $( document ).ready( function( $ ) {

  	// Search in Header.
  	var $search_icon_obj = $( '.search-icon', '.header-search-box' );
  	if( $search_icon_obj.length > 0 ) {
  		$search_icon_obj.click( function( e ) {
  			e.preventDefault();
  			$( this ).siblings('.search-box-wrap').slideToggle();
  		});
  	}

    // Trigger mobile menu.
    $('#mobile-trigger').sidr({
		timing: 'ease-in-out',
		speed: 500,
		source: '#mob-menu',
		name: 'sidr-main'
    });

    // Implement go to top.
	var $scroll_obj = $( '#btn-scrollup' );
	$( window ).scroll(function(){
		if ( $( this ).scrollTop() > 100 ) {
			$scroll_obj.fadeIn();
		} else {
			$scroll_obj.fadeOut();
		}
	});

	$scroll_obj.click(function(){
		$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
		return false;
	});


  });

} )( jQuery );
