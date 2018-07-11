/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the placeholder image settings and informs the preview.
 */

(function() {
	wp.customize.bind( 'ready', function() {

		// Only show the placeholder image settings when there's a card style layout.
		wp.customize( 'archive_style', function( setting ) {
			wp.customize.control( 'archive_placefolder_image', function( control ) {
				var visibility = function() {
					if ( 'card' === setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});
		});

	});
})( jQuery );
