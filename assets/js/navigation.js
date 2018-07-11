(function() {
	var btn, drawer, page, mask;

	btn = document.querySelector( '.menu-toggle' );
	drawer = document.querySelector( '#drawer' );
	page = document.querySelector( '#page' );
	mask = document.querySelector( '#drawer-mask' );

	if ( ! btn ) {
		return;
	}

	function drawerOpen() {
		btn.setAttribute( 'aria-expanded', 'true' );
		drawer.setAttribute( 'aria-hidden', 'false' );
		page.classList.add( 'drawer-open' );
	}

	function drawerClose() {
		btn.setAttribute( 'aria-expanded', 'false' );
		drawer.setAttribute( 'aria-hidden', 'true' );
		page.classList.remove( 'drawer-open' );
	}

	// Processing the drawer menu
	btn.addEventListener( 'click', function() {
		page.classList.contains( 'drawer-open' ) ? drawerClose() : drawerOpen();
	}, false);

	// Processing when an overlay is clicked
	mask.addEventListener( 'click', function() {
		drawerClose();
	}, false);

	window.addEventListener( 'keydown', function(e) {
		if ( ( e.key == 'Escape' || e.key == 'Esc' || e.keyCode == 27 ) && page.classList.contains( 'drawer-open' ) ) {
			drawerClose();
		}
	}, false);

})();
