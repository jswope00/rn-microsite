( function( $ ) {
  $( function() {
    $( ".read-more" ).hover( function() {
    	$(this).parents('.format-link').css('z-index', 999);
    	$( this ).next().slideToggle( "slow" );  
  	});
  } );
} )( jQuery );
