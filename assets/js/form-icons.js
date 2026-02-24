'use strict';

( function ( $ ) {

    if ( typeof elementorFrontend === 'undefined' ) return;

    var isEditMode = elementorFrontend.isEditMode();

    function getWidgetData( widgetId ) {
        if ( isEditMode && typeof elementor !== 'undefined' ) {
            try {
                var container = elementor.getContainer( widgetId );
                if ( ! container ) return null;
                var formFields = container.settings.get( 'form_fields' );
                if ( ! formFields ) return null;
                var data = {};
                formFields.each( function ( field ) {
                    if ( field.get( 'mbr_enable_icon' ) !== 'yes' ) return;
                    var iconObj   = field.get( 'mbr_selected_icon' );
                    var iconValue = iconObj && iconObj.value ? iconObj.value : '';
                    if ( ! iconValue ) return;
                    var fieldId   = field.get( 'custom_id' );
                    if ( ! fieldId ) return;
                    var fieldType = field.get( 'field_type' ) || '';
                    var sizeObj   = field.get( 'mbr_icon_size' );
                    data[ fieldId ] = {
                        icon     : iconValue,
                        position : field.get( 'mbr_icon_position' ) || 'above',
                        color    : field.get( 'mbr_icon_color' )    || '#333333',
                        size     : sizeObj && sizeObj.size ? parseInt( sizeObj.size, 10 ) : 16,
                        type     : fieldType
                    };
                } );
                return data;
            } catch ( e ) {
                return null;
            }
        }
        return ( window.mbrEfiData || {} )[ widgetId ] || null;
    }

    function findFieldGroup( $el, fieldId, fieldType ) {
        var $group = $el.find( '.elementor-field-group-' + fieldId );
        if ( $group.length ) return $group;
        if ( fieldType ) {
            $group = $el.find( '.elementor-field-type-' + fieldType ).first();
            if ( $group.length && ! $group.find( '.mbr-efi-icon, .mbr-efi-placeholder-icon' ).length ) {
                return $group;
            }
        }
        return $();
    }

    function injectIcons( widgetId ) {
        var el = document.querySelector( '.elementor-element-' + widgetId );
        if ( ! el || ! document.body.contains( el ) ) return;

        var data = getWidgetData( widgetId );
        if ( ! data ) return;

        var $el = $( el );

        // First pass: reset any orphaned padding (icon gone but padding remains)
        $el.find( 'input.mbr-efi-padded, textarea.mbr-efi-padded' ).each( function() {
            var $input = $( this );
            var $group = $input.closest( '.elementor-field-group' );
            if ( ! $group.find( '.mbr-efi-placeholder-icon' ).length ) {
                $input.css( 'padding-left', '' ).removeClass( 'mbr-efi-padded' );
            }
        } );

        $.each( data, function ( fieldId, field ) {
            var $group = findFieldGroup( $el, fieldId, field.type );
            if ( ! $group.length ) return;

            if ( $group.find( '.mbr-efi-icon, .mbr-efi-placeholder-icon' ).length ) return;

            var iconStyle = 'color:' + field.color + ';font-size:' + field.size + 'px;line-height:1;';

            if ( field.position === 'above' ) {
                var $label = $group.find( 'label' ).first();
                if ( ! $label.length ) return;
                $label.prepend( $( '<i>', {
                    'class': field.icon + ' mbr-efi-icon',
                    'aria-hidden': 'true',
                    'style': iconStyle + 'display:inline-block;margin-right:5px;vertical-align:middle;'
                } ) );
            } else {
                $group.css( 'position', 'relative' );
                var $input = $group.find( 'input, textarea' ).first();
                if ( ! $input.length ) return;
                var isTextarea = $input.is( 'textarea' );
                var inputTop    = $input[0].offsetTop;
                var inputHeight = $input[0].offsetHeight;
                var iconPos = isTextarea
                    ? 'position:absolute;left:12px;top:' + ( inputTop + 10 ) + 'px;transform:none;pointer-events:none;z-index:1;'
                    : 'position:absolute;left:12px;top:' + ( inputTop + Math.floor( inputHeight / 2 ) ) + 'px;transform:translateY(-50%);pointer-events:none;z-index:1;';
                $group.append( $( '<i>', {
                    'class': field.icon + ' mbr-efi-placeholder-icon',
                    'aria-hidden': 'true',
                    'style': iconStyle + iconPos
                } ) );
                $input.addClass( 'mbr-efi-padded' ).css( 'padding-left', ( field.size + 20 ) + 'px' );
                $input.on( 'input.mbrEfi change.mbrEfi', function () {
                    $group.find( '.mbr-efi-placeholder-icon' ).toggle( $( this ).val() === '' );
                } );
            }
        } );
    }

    function injectAllForms() {
        var widgets = document.querySelectorAll( '.elementor-widget-form' );
        widgets.forEach( function( widget ) {
            if ( document.body.contains( widget ) ) {
                injectIcons( widget.dataset.id );
            }
        } );
    }

    var pollCount = 0;
    var interval = setInterval( function() {
        injectAllForms();
        pollCount++;
        if ( pollCount >= 20 ) {
            clearInterval( interval );
            setInterval( injectAllForms, 2000 );
        }
    }, 200 );

    function tryRegisterHandler() {
        if ( typeof elementorModules === 'undefined' || ! elementorFrontend.hooks ) return;
        var Handler = elementorModules.frontend.handlers.Base.extend( {
            onInit: function () {
                elementorModules.frontend.handlers.Base.prototype.onInit.apply( this, arguments );
                injectIcons( this.getID() );
            }
        } );
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/form.default',
            function ( $scope ) {
                elementorFrontend.elementsHandler.addHandler( Handler, { $element: $scope } );
            }
        );
    }

    $( window ).on( 'elementor/frontend/init', tryRegisterHandler );
    if ( elementorFrontend.hooks ) tryRegisterHandler();

    $( function () { setTimeout( injectAllForms, 500 ); } );

} ( jQuery ) );
