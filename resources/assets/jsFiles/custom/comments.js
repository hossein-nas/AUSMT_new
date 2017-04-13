$( document ).ready( function ()
{

	$( '.comment .reply' ).click( function ()
	{
		window.location = '#' + $( this ).data( 'parent' );
	} );

	$( '.rep' ).click( function ()
	{
		window.location = '#'+'write-comment';
		var scroll_pos = $(document).scrollTop();
		$(document).scrollTop(scroll_pos-50);
		$( '.write-comment .replier' ).remove();
		var rep = '<label for="replier" class="replier"><a href="#';
		var id = $( this ).parent().attr( 'id' );
		var name = $( this ).parent().find( '.name' ).html()
		rep = rep + id + '">' + name + '</a><span class="cancel"></span></label>';
		id = id.replace( 'num-', '' );
		id = parseInt( id );
		$( 'input[name="parent_id"]' ).val( id );
		$( '.write-comment' ).prepend( rep );

		$( '.replier .cancel' ).click( function ()
		{
			$( this ).parent().remove();
			$( 'input[name="parent_id"]' ).val( 0 );
		} );
	} )

} );