$(function() {
    var ape = new APE.Client();

    ape.load();
    ape.addEvent( 'load', function() {
        console.log( 'load event' );
        ape.core.start( {
            'name' : 'Guest' + String(new Date().getTime()).substr(5)
        } );
    } );
    ape.addEvent( 'ready', function() {
        console.log( 'ready event' );

        ape.core.join( 'SpaceStatusChannel' );

        ape.addEvent( 'multiPipeCreate', function( pipe, options ) {
            pipe.send( 'Hello!' );
            console.log( 'sending hello' );
        } );

        ape.onRaw( 'data', function( raw, pipe ) {
            console.log( 'Receiving: ' + unescape( raw.data.msg ) );
        } );
    } );
});
