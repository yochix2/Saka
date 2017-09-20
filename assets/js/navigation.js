(function($) {
	var btn, drawer, page, mask;

	btn = $( '.menu-toggle' );
	drawer = $( '.drawer' );
	page = $( '#page' );
	mask = $( '#drawer-mask' );

	if ( ! btn ) {
		return;
	}

	function drawerOpen() {
		btn.attr( 'aria-expanded', 'true' );
		drawer.attr( 'aria-hidden', 'false' );
		page.addClass( 'drawer-open' );
	}

	function drawerClose() {
		btn.attr ('aria-expanded', 'false' );
		drawer.attr( 'aria-hidden', 'true' );
		page.removeClass( 'drawer-open' );
	}

	// Processing the drawer menu
	btn.on( 'click', function() {
		page.hasClass( 'drawer-open' ) ? drawerClose() : drawerOpen();
	} );

	// Close the menu with the Esc key
	$(document).on( 'keyup', function(event) {
		if ( event.keyCode == 27 && page.hasClass( 'drawer-open' ) ) {
			drawerClose();
		}
	} );

	// Processing when an overlay is clicked
	mask.on( 'click', function() {
		drawerClose();
	} );

})(jQuery);
