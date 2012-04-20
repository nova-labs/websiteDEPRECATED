(function( $ ) {
$.fn.ipe = function( options ) {

var opt = {
    url                     : $(location).attr( 'href' ),

    save_on_enter           : true,
    cancel_on_esc           : true,
    focus_edit              : true,
    select_text             : false,
    select_options          : false,
    data                    : false,

    form_type               : "text", // text, textarea, select
    size                    : 0,
    max_size                : 60,
    rows                    : 0,
    max_rows                : 10,
    cols                    : 60,

    savebutton_text         : "SAVE",
    savebutton_class        : "ipe-savebutton",
    cancelbutton_text       : "CANCEL",
    cancelbutton_class      : "ipe-cancelbutton",

    mouseover_class         : "ipe-mouseover",
    editor_class            : "ipe-editor",
    editfield_class         : "ipe-editfield",

    saving_text             : "Saving ...",
    saving_class            : "ipe-saving",

    saving                  : '<span id="saving-#{id}" class="#{saving_class}" style="display: none;">#{saving_text}</span>',

    form_buttons            : '<span><input type="button" id="save-#{id}" class="#{savebutton_class}" value="#{savebutton_text}" /> OR <input type="button" id="cancel-#{id}" class="#{cancelbutton_class}" value="#{cancelbutton_text}" /></span>',
    stop_form               : '</span>',

    text_form               : '<input type="text" id="edit-#{id}" class="#{editfield_class}" value="#{value}" /> <br />',
    textarea_form           : '<textarea cols="#{cols}" rows="#{rows}" id="edit-#{id}" class="#{editfield_class}">#{value}</textarea> <br />',
    start_select_form       : '<select id="edit-#{id}" class="#{editfield_class}">',
    select_option_form      : '<option id="edit-option-#{id}-#{option_value}" value="#{option_value}" #{selected}>#{option_text}</option>',
    stop_select_form        : '</select>',

    on_success              : function( self ) {
        var x = $( self );
        for( var i = 0; i < 2; i++ ) {
            x.fadeOut( "fast" );
            x.fadeIn( "fast" );
        }
    },
    on_error            : function( msg ) {
        alert( "Error: " + msg );
    }
};

if ( options ) {
    $.extend( opt, options );
}

this.each( function( ) {
    $( this ).bind( "mouseenter mouseleave", function( e ) {
        $( this ).toggleClass( opt.mouseover_class );
    } );

    $( this ).bind( "click", function( e ) { _start_edit( this ); } );
} );

var _start_edit = function( self ) {
    $( self ).unbind( "click" );

    $( self ).removeClass( opt.mouseover_class );
    $( self ).fadeOut( "fast", function( e ) {
        var id              = self.id;
        var value           = $( self ).html();

        var safe_value      = value.replace( /</g, "&lt;" );
        safe_value          = value.replace( />/g, "&gt;" );
        safe_value          = value.replace( /"/g, "&quot;" );

        var orig_option_value = false;
        var form = _form( $( self ) );

        form += _template( opt.form_buttons, {
            id                    : self.id,
            savebutton_class    : opt.savebutton_class,
            savebutton_text        : opt.savebutton_text,
            cancelbutton_class    : opt.cancelbutton_class,
            cancelbutton_text    : opt.cancelbutton_text
        } );

        form += _template( opt.stop_form, { } );

        $( self ).after( form );
        $( "#editor-" + self.id ).fadeIn( "fast" );

        if( opt.focus_edit ) {
            $( "#edit-" + self.id ).focus( );
        }

        if( opt.select_text ) {
            $( "#edit-" + self.id ).select( );
        }

        $( "#cancel-" + self.id ).bind( "click", function( e ) {
            _cancelEdit( self );
        } );

        $( "#edit-" + self.id ).keydown( function( e ) {
            // cancel
            if( e.which == 27 ) {
                _cancelEdit( self );
            }

            // save
            if( opt.form_type != "textarea" && e.which == 13 ) {
                _saveEdit( self, orig_option_value );
            }
        } );

        $( "#save-" + self.id ).bind( "click", function( e ) {
            return _saveEdit( self, orig_option_value );
        } ); // save click
    } ); // this fadeOut
};

var _form = function( el ) {

    var form = $( '<form/>', {
        id      : 'ipe-' + el.id,
        class   : 'ipe-editor form-inline',
        style   : 'display: none;'
    } );

    var type_fn = '_' + el.attr( 'type' ) + '_field';
    form += type_fn( el );
};

var _text_field = function( el ) {
    /*
        form += _template( opt.text_form, {
            id                : self.id,
            editfield_class    : opt.editfield_class,
            value            : value
        } );
    */
};

var _textarea_field = function( el ) {
    var length = value.length;
    var rows = ( length / opt.cols ) + 2;

    for( var i = 0; i < length; i++ ) {
        if( value.charAt( i ) == "\n" ) {
            rows++;
        }
    }

    if( rows > opt.max_rows ) {
        rows = opt.max_rows;
    }
    if( opt.rows != false ) {
        rows = opt.rows;
    }
    rows = parseInt( rows );

    form += _template( opt.textarea_form, {
        id                : self.id,
        cols            : opt.cols,
        rows            : rows,
        editfield_class    : opt.editfield_class,
        value            : value
    } );
};

var _select_field = function( el ) {
    /*
    form += _template( opt.start_select_form, {
        id                : self.id,
        editfield_class    : opt.editfield_class
    } );

        $.each( opt.select_options, function( k, v ) {
            var selected = '';
            if( v == value ) {
                selected = 'selected="selected"';
            }

            if( value == v ) {
                orig_option_value = k;
            }

            form += _template( opt.select_option_form, {
                id            : self.id,
                option_value: k,
                option_text    : v,
                selected    : selected
            } );
        } );

        form += _template( opt.stop_select_form, { } );
    */
};


        var _template = function( template, values ) {
            var replace = function( str, match ) {
                return typeof values[match] === "string" || typeof values[match] === 'number' ? values[match] : str;
            };
            return template.replace( /#\{([^{}]*)}/g, replace );
        };

        var _trim = function( str ) {
            return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
        }

        var _cancelEdit = function( self ) {
            $( "#editor-" + self.id ).fadeOut( "fast" );
            $( "#editor-" + self.id ).remove( );

            $( self ).bind( "click", function( e ) {
                _editMode( self );
            } );

            $( self ).removeClass( opt.mouseover_class );
            $( self ).fadeIn( "fast" );
        };
        
        var _saveEdit = function( self, orig_option_value ) {
            var orig_value = $( self ).html( );
            var new_value = $( "#edit-" + self.id ).attr( "value" );

            if( orig_value == new_value ) {
                $( "#editor-" + self.id ).fadeOut( "fast" );
                $( "#editor-" + self.id ).remove( );

                $( self ).bind( "click", function( e ) {
                    _editMode( self );
                } );

                $( self ).removeClass( opt.mouseover_class );
                $( self ).fadeIn( "fast" );

                return true;
            }

            $( "#editor-" + self.id ).after( _template( opt.saving, {
                id            : self.id,
                saving_class: opt.saving_class,
                saving_text    : opt.saving_text
            } ) );
            $( "#editor-" + self.id ).fadeOut( "fast", function( ) {
                $( "#saving-" + self.id).fadeIn( "fast" );
            } );

            var ajax_data = {
                url            : location.href,
                id            : self.id,
                form_type    : opt.form_type,
                orig_value    : orig_value,
                new_value    : $( "#edit-" + self.id ).attr( "value" ),
                data        : opt.data
            }

            if( opt.form_type == 'select' ) {
                ajax_data.orig_option_value = orig_option_value;
                ajax_data.orig_option_text = orig_value;
                ajax_data.new_option_text = $( "#edit-option-" + self.id + "-" + new_value ).html( );
            }

            $.ajax( {
                url        : opt.save_url,
                type    : "POST",
                dataType: "json",
                data    : ajax_data,
                success    : function( data ) {
                    $( "#editor-" + self.id ).fadeOut( "fast" );
                    $( "#editor-" + self.id ).remove( );

                    if( data.is_error == true ) {
                        opt.on_error( data.error_text );
                    }
                    else {
                        $( self ).html( data.html );
                    }

                    $( "#saving-" + self.id ).fadeOut( "fast" );
                    $( "#saving-" + self.id ).remove( );

                    $( self ).bind( "click", function( e ) {
                        _editMode( self );
                    } );

                    $( self ).addClass( opt.mouseover_class );
                    $( self ).fadeIn( "fast" );

                    if( opt.after_save != false ) {
                        opt.after_save( self );
                    }

                    $( self ).removeClass( opt.mouseover_class );
                } // success
            } ); // ajax
        }; // _saveEdit


    }; // inplaceEdit
})( jQuery );
