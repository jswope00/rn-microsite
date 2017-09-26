( function( $ ) {










  $( function() {

    $( ".read-more" ).hover( function() {
    	console.log('custom-excerpt-event');
    	// console.log('')
    	// console.log($(this).parents());
    	$(this).parents('.format-link').css('z-index', 999);
    	$( this ).next().slideToggle( "slow" );  
  	});


  } );
} )( jQuery );
