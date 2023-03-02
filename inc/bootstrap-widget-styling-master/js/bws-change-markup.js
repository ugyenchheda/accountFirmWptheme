( function( $ ) {
	$( function() {

		// widget markup to be edited
		var recentPostsWidget = $( '.widget_recent_entries' );
		var recentCommentWidget = $( '.widget_recent_comments' );
		var metaWidget = $( '.widget_meta' );

		$.map( [ recentPostsWidget , recentCommentWidget , metaWidget ] , formatWidgetForBootstrap );
		function formatWidgetForBootstrap( $widget ) {
			var allAnchors = [];
			/* new */
			$widget.find( 'ul li:not(.awr-edit-icons)' ).map( function() { // turn each li tag into an anchor, store in allAnchors
				var span = getSpan( $( this ) ).clone().addClass( 'label label-primary pull-right' );
				var clearfixDiv = $( '<div>' ).attr( 'class' , 'clearfix' );
				var anchor = $( this ).find( 'a' ).last().clone();
				anchor.addClass( 'list-group-item' ).append( '&nbsp;' ).append( span ).append( clearfixDiv );
				$( this ).remove( 'span' );
				allAnchors.push( anchor );
			} );

			// Create a new div containing allAnchors from previous function
			newListGroupDiv = $( '<div>' ).addClass( 'list-group' ).append( allAnchors );
			$widget.append( newListGroupDiv );
			$widget.find( 'ul:not(.awr-edit-controls)' ).remove(); // remove the ul that the original li tags were from

			function getSpan( $container ) {
				var $span = $container.find( 'span' );
				var child_anchor = $span.find( 'a' );
				if ( child_anchor.length ) {
					return $( '<span>' ).append( child_anchor.html() );
				}
				return $span;
			}
		}

	} );
} )( jQuery );
