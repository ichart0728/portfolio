jQuery(document).ready(function($) {	

    $( ".tmp-control-range-size" ).each(function(){
        $self = $(this);
        $self.slider({
            range: "min",
            value: parseInt($self.attr('value')),
            min: parseInt($self.attr('data-min')),
            max: parseInt($self.attr('data-max')),
            step: parseInt($self.attr('data-step')),
            slide: function( event, ui ) {
                $self.prev( ".tmp-range-value-size" ).text( ui.value );

                var setting = $self.prev( ".tmp-range-value-size" ).attr( 'data-customize-setting-link' );

                // Set the new value.
                wp.customize( setting, function( obj ) {

                    obj.set( ui.value );
                });

            }
        });
    });

    /**
     * Multiple checkboxes
     */
    /* === Checkbox Multiple Control === */

    $( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on( 'change', function() {
        checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
            function() {
                return this.value;
            }
        ).get().join( ',' );

        $( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
    });

});