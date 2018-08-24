( function ( $, window ) {
	$( document ).ready( function () {
		var awsCredentials     = $( '#aws_credentials_submit' );
		var awsCloudWatchGroup = $( '#aws_cloud_watch_submit' );
		
		/**
		 * Submit Aws Crediantials.
		 */
		awsCredentials.click( function () {
			event.preventDefault();
			var data     = {};
			var formData = $( this ).closest( 'form' ).serializeArray();
			$.each( formData, function ( key, value ) {
				data[ value.name ] = value.value;
			} );
			
			$.post(
				aws_localize_ajax.ajax_url,
				{
					'action': 'aws_credentials',
					'data'  : data
				},
				function ( response ) {
					window.location.href = '';
				}
			);
		} );
		
		/**
		 * Submit Region
		 */
		awsCloudWatchGroup.click( function () {
			event.preventDefault();
			var data     = {};
			var formData = $( this ).closest( 'form' ).serializeArray();
			$.each( formData, function ( key, value ) {
				data[ value.name ] = value.value;
			} );
			
			$.post(
				aws_localize_ajax.ajax_url,
				{
					'action': 'aws_cloud_watch_region',
					'data'  : data
				},
				function ( response ) {
					window.location.href = '';
				}
			);
		} );
		
	} );
} )( jQuery, window );