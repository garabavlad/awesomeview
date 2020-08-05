// scroll to top button
jQuery( document ).ready( function ( $ ) 
{
    // Menu fixes
    $( function () {
        if ( $( window ).width() > 767 ) {
            $( ".dropdown" ).hover(
                function () {
                    $( this ).addClass( 'open' )
                },
                function () {
                    $( this ).removeClass( 'open' )
                }
            );
        }
    } );
    $( '.navbar .dropdown-toggle' ).hover( function () {
        $( this ).addClass( 'disabled' );
    } );
    $( window ).scroll( function () {
        var topmenu = $( '#top-navigation' ).outerHeight();
        var mainmenu = $( '.site-header' ).outerHeight();
        if ( $( document ).scrollTop() > ( topmenu + mainmenu + 50 ) ) {
            $( 'nav#site-navigation' ).addClass( 'shrink' );
        } else {
            $( 'nav#site-navigation' ).removeClass( 'shrink' );
        }
    } );
    
    $('.open-panel').each(function(){
        var menu = $( this ).data( 'panel' );
        $( "#" +menu ).click( function () {
            $( "#blog" ).toggleClass( "openNav" );
            $( "#" +menu+ ".open-panel" ).toggleClass( "open" );
        } );
    });
    
    $( '.top-search-icon' ).click(function() {
        $( ".top-search-box" ).toggle( 'slow' );
        $( ".top-search-icon .fa" ).toggleClass( "fa-times fa-search" );
    });
    
    $( ".split-slider.news-item-3" ).hover(function() {
        $( ".news-item-2" ).toggleClass( "split-slider-left" );
      });


    // Checkout page checkbox fix
    if(window.location.pathname == "/awesome/checkout/")
    {
        $( "input:checkbox" ).attr('checked',false);
        $( "#terms" ).css({position: 'relative', width: 'auto'});

        window.onload =  function(){
            $( "#terms" ).css({position: 'relative', width: 'auto'});
        }
    }

    switch(window.location.pathname)
    {
        case "/awesome/shop/":
        case "/awesome/cart/":
        case "/awesome/orders/":
            $('#menu-item-249').addClass('active');
            break;
        
        case "/awesome/pool/":
        case "/awesome/spa/":
        case "/awesome/restaurant/":
        case "/awesome/massage/":
        case "/awesome/housing/":
        case "/awesome/fitness/":
            $('#menu-item-285').addClass('active');
            break;

        case "/awesome/reservations-pool/":
        case "/awesome/reservations-spa/":
        case "/awesome/reservations-massage/":
        case "/awesome/reservations-fitness/":
            $('#menu-item-286').addClass('active');
            break;
    }

    $('#awesome-new-swimming-anch').click(function(e) {
        $('#new_booking_form').collapse('show');

    });

    $("#swimming-new-booking-confirm-btn").click(function (a) {
        var selected_hour = document.getElementById("swimming_select_hour").value;
        var date_input = document.getElementById("swimming_date_picker").value;
        var selected_date = formatDate(new Date(date_input));

        $("#swimming-new-booking-modal-body")
            .html('Are you sure you want to make a new booking on:' +
                '<br><b>Date: ' + selected_date + "</b>" +
                '<br><b>Time: ' + selected_hour + "</b>" +
                '<br>Confirming now it might be impossible to cancel it later! <a href=\'#\'>Learn more</a>');
    });

} );
// end rdy func


jQuery( window ).on( 'load resize', function () {   
    // Mobile menu height fix
    if ( jQuery( window ).width() < 768 ) {
        var vindowHeight = jQuery( window ).height();
        var navHeight = jQuery( '#site-navigation' ).height();
        jQuery( '.menu-container' ).css( 'max-height', vindowHeight - navHeight + 'px' );
        jQuery( '.menu-container' ).css( 'padding-bottom', '60px' );
    }
} );
jQuery('#menu-item-77').addClass('popmake-75');


function formatDate(date) {
    var monthNames = [
        "January", "February", "March",
        "April", "May", "June", "July",
        "August", "September", "October",
        "November", "December"
    ];

    var day = (date.getDate());
    var monthIndex = date.getMonth();
    var year = date.getFullYear();

    return day + ' ' + monthNames[monthIndex] + ' ' + year;
}


function close_f(){
    jQuery('#massageModalClose').click();
    // jQuery('#massageModalClose6').click();
}