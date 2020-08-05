

/** SETTING JS TIMEZONE */

Date.prototype.toDateInputValue = (function()
{
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});


/** HANDLE SUBMIT BUTTON FROM MANEGE CONFIRMATION PAGE */

$('#confirmation_approve_manege').attr('disabled', 'disabled');

function update_manege_confirmation_submit()
{
    if (check_manege_confirmation_select())
    {
        $('#confirmation_approve_manege').attr('disabled', false);
    }
    else
    {
        $('#confirmation_approve_manege').attr('disabled', true);
    }
}

function check_manege_confirmation_select()
{
    return ($('#horse_select').val() != '' && $('#instructor_select').val() != '');
}

$('#instructor_select').change(update_manege_confirmation_submit);
$('#horse_select').change(update_manege_confirmation_submit);


/** HANDLE SUBMIT BUTTON FROM MASSAGE CONFIRMATION PAGE */

// $('#confirmation_approve_massage').attr('disabled', 'disabled');
//
// function update_massage_confirmation_submit()
// {
//     if (check_massage_confirmation_select())
//     {
//         $('#confirmation_approve_massage').attr('disabled', false);
//     }
//     else
//     {
//         $('#confirmation_approve_massage').attr('disabled', true);
//     }
// }
//
// function check_massage_confirmation_select()
// {
//     return ($('#masseur_select').val() != '');
// }
//
// $('#masseur_select').change(update_massage_confirmation_submit);


/** SUB-MENU CREATING LINES FOR SECTIONS */

$('document').ready(function()
{
    $('#menu-item-2879').html('<hr>');
    $('#menu-item-2880').html('<hr>');
});



 /************************************ HISTORY TABLE TABS CONTROL *************************************/

 function showSelectedHistoryTable(evt, selectName)
{
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("histoy_tab_content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("histoy_tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(selectName).style.display = "block";
    evt.currentTarget.className += " active";

}
// Open first tab on history page
if(location.pathname === '/rad/history-table/')
    document.getElementById("defaultHistoryTab").click();


/** RESERVATION TABLE TABS CONTROL */

function showSelectedReservationTable(evt, selectName)
{
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("reservation_tab_content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("reservation_tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(selectName).style.display = "block";
    evt.currentTarget.className += " active";

}
// Open default tab on reservation page
if(location.pathname === '/rad/reservation-table/')
    document.getElementById("defaultReservationTab").click();

/*****************************************  SPA  ******************************************/

// date onchange checking date
// if weekend => block button
function spa_check_week_day()
{
    var day = new Date(document.getElementById("date_input_spa").value);

    if(!(day.getDay() % 6))
    {
        $('#spa_lv_button').attr('disabled', true);
        $('#spa_sd_button').attr('disabled', false);
    }
    else
    {
        $('#spa_lv_button').attr('disabled', false);
        $('#spa_sd_button').attr('disabled', true);
    }
}
if(location.pathname === '/rad/reservation-table/')
    spa_check_week_day();

// Masseur list ajax request from massage confirm page
function masseur_ajax() {
    $.ajax({
        url: '/rad/wp-content/themes/photologger/external/script_massage....php',
        type: 'POST',
        data: {
            date: $("#date_hid").val(),
            select: $('#massage_time_select').val()
        },
        success:function(response){
            $("#masseur-select-div").html(response);
        },
        error:function (response) {
            alert("An unexpected error occured. Please try again later!"+response);
        }
    });
}

$('#massage_time_select').on('change', masseur_ajax);

$( document ).ready(function() {
    if(location.pathname === '/rad/confirm-reservation/')
        masseur_ajax();
});



