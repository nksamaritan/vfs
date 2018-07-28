/**
 * @file
 * A JavaScript file for Application configuration
 *
 */


// Define App and datatable variable

var app = app || {};
var dataTable, searchBtn;

app.config = {
    SITE_PATH: baseUrl,
    init: function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
};

// Log data in console
function l(data) {
    console.log(data);
}

// Check string is valid json or not
function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}


// Show loading mask
app.showLoader = function (id) {
    $((id) ? id : 'body').mask("<img src='" + app.config.SITE_PATH + "/img/loading.svg'");
}

// Hide loading mask
app.hideLoader = function (id) {
    $((id) ? id : 'body').unmask();
}

// Remove loading mask
app.removeLoader = function () {
    $('.loadmask').remove();
    $('.loadmask-msg').remove();
    $('div.masked').removeClass('masked');
}

//Check for mobile device
var isMobile = {
    Android: function () {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function () {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function () {
        return navigator.userAgent.match(/iPhone|iPod/i);
    },
    ipad: function () {
        return navigator.userAgent.match(/iPad/i);
    },
    Opera: function () {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function () {
        return navigator.userAgent.match(/IEMobile/i);
    },
    BB: function () {
        return navigator.userAgent.match(/BB10/i);
    },
    any: function () {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows() || isMobile.BB());
    }
};

// Check all check box
app.checkAll = function () {
    $('#checkAll').on('click', function () {
        $('.checkAllChild').prop('checked', $(this).is(":checked"));
    });

    $('.checkAllChild').on('click', function () {
        if ($(this).is(":checked")) {
            if ($('.checkAllChild').length === $('.checkAllChild:checked').length) {
                $('#checkAll').prop('checked', $(this).is(":checked"));
            }
        } else {
            $('#checkAll').prop('checked', $(this).is(":checked"));
        }
    });
}

// change status

app.changeStatus = function (id,url,status) {

    $.ajax({
        type: "POST",
        url: url,
        data: { id : id,status:status,_token: csrf_token}
    }).done(function(data){
        location.reload();
    });
}

// Delete Record

app.deleteRecord = function (id,url) {
    $.ajax({
        type: "POST",
        url: url,
        data: { id : id,_token: csrf_token}
    }).done(function(data){
        location.reload();
    });
}

// datepicker
app.datepicker = function (param) {
    $("#"+param).datetimepicker({
        formatDate: 'd.m.Y',
        format:'d-M-Y',
        timepicker:false,
        closeOnDateSelect:true
    });
}

app.validate = {
    init:function (params) {
        if(typeof params != undefined) {
            $("#app_form").validate(params);
        }else{
            $("#app_form").validate();
        }
    }
}

// Hide Flash and validation message
setTimeout(function(){
    $(".flash-message").slideUp(500).html("");
    $(".validator_message").slideUp(500).html("");

},5000);