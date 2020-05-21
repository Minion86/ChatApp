jQuery.fn.exists = function () {
    return this.length > 0;
}

$(document).ready(function () {



    callAPI();

    var div = $("#msg_history");
    div.scrollTop(div.prop('scrollHeight'));


    $(document).on("click", ".close-modal", function () {
        var id = $(this).data("id");
        $(id).modal('hide');
    });


    $.validate({

        form: '#frm',
        onError: function () {
        },
        onSuccess: function () {
            var params = $("#frm").serialize();
            var action = $("#frm #action").val();
            var button = $('#frm button[type="submit"]');
            dump(button);
            callAjax(action, params, button);
            return false;
        }
    });



    if ($(".chosen").exists()) {
        $(".chosen").chosen({
            allow_single_deselect: true,
            width: '100%'
        });
    }



}); /*end docu*/

function empty(data)
{
    //if (typeof data == "undefined" || data==null || data=="" ) { 
    if (typeof data == "undefined" || data == null || data == "" || data == "null" || data == "undefined") {
        return true;
    }
    return false;
}

function dump(data)
{
    console.debug(data);
}

var ajax_request;

function callAPI()
{
    ajax_request = $.ajax({
        url: 'http://data.fixer.io/api/latest?access_key=1eea67f534f316bf888a1cfcbf0fa42e',
        type: 'get',
        //async: false,
        dataType: 'json',
        timeout: 6000,
        beforeSend: function () {
            dump("before=>");
            dump(ajax_request);
            if (ajax_request != null) {
                ajax_request.abort();
                dump("ajax abort");
            }
        },
        complete: function (data) {
            ajax_request = (function () {
                return;
            })();
            dump('Completed');
            dump(ajax_request);
        },
        success: function (data) {
            dump(data);
            if (data.success == true) {

                $('#currency').empty();
                $.each(data.rates, function (i, p) {
                    $('#currency').append($('<option></option>').val(i).html(i));
                });

            } else {

                // failed mycon
                switch (action)
                {
//                    default :
//                        Swal.fire({title: 'Warning', text: data.msg, icon: 'warning', showCancelButton: false, confirmButtonColor: '#3085d6',
//                            confirmButtonText: 'Ok'});
//                        break;

                }

            }
        },
        error: function (request, error) {
            Swal.fire({title: 'Error', text: error, icon: 'error', showCancelButton: false, confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'});

        }
    });
}

function callAPIChat()
{
    ajax_request = $.ajax({
        url: 'http://data.fixer.io/api/latest?access_key=1eea67f534f316bf888a1cfcbf0fa42e',
        type: 'get',
        //async: false,
        dataType: 'json',
        timeout: 6000,

        complete: function (data) {
            ajax_request = (function () {
                return;
            })();
            dump('Completed');
            dump(ajax_request);
        },
        success: function (data) {
            dump(data);
            if (data.success == true) {

                $('.currency').empty();
                $.each(data.rates, function (i, p) {
                    $('.currency').append($('<option></option>').val(i).html(i));
                });


            } else {

                // failed mycon
                switch (action)
                {
//                    default :
//                        Swal.fire({title: 'Warning', text: data.msg, icon: 'warning', showCancelButton: false, confirmButtonColor: '#3085d6',
//                            confirmButtonText: 'Ok'});
//                        break;

                }

            }
        },
        error: function (request, error) {
            Swal.fire({title: 'Error', text: error, icon: 'error', showCancelButton: false, confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'});

        }
    });
}

/*mycall*/
function callAjax(action, params, button)
{
    dump(ajax_url + "/" + action + "?" + params);

    ajax_request = $.ajax({
        url: ajax_url + "/" + action,
        data: params,
        type: 'post',
        //async: false,
        dataType: 'json',
        timeout: 6000,
        beforeSend: function () {
            dump("before=>");
            dump(ajax_request);
            if (ajax_request != null) {
                ajax_request.abort();
                dump("ajax abort");
                busy(false, button);
            } else {
                busy(true, button);
            }
        },
        complete: function (data) {
            ajax_request = (function () {
                return;
            })();
            dump('Completed');
            dump(ajax_request);
            busy(false, button);
        },
        success: function (data) {
            dump(data);
            if (data.code == 1) {

                switch (action)
                {
                    case "login":
                        window.location.href = data.details;

                        break;

                    case "addUser":

                        Swal.fire({title: 'Success', text: data.msg, icon: 'success', showCancelButton: false, confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'}).then((result) => {
                            if (result.value) {
                                window.location.href = 'user/login';
                            }
                        });
                        break;
                    case "addMessage":
                        $('#msg_history').val("");
                        $('#message').val("");

                        var chats = '';

                        $.each(data.details, function (i, obj) {
                            if (obj.sender == "user")
                            {
                                chats += "<div class='outgoing_msg'> <div class='sent_msg'> \n\
                       <p>" + obj.message + "</p><span class='time_date'> " + obj.date_sent + "</span> </div></div>";
                            } else if (obj.sender == "chatbot")
                            {
                                chats += "<div class='incoming_msg'><div class='incoming_msg_img'> \n\
                        <img src='https://ptetutorials.com/images/user-profile.png' alt='sunil'> </div>\n\
                        <div class='received_msg'> <div class='received_withd_msg'><p>" + obj.message + "</p>\n\
                        <span class='time_date'> " + obj.date_sent + "</span></div></div></div>";
                            }
                        });
                        $(".msg_history").append(chats);
                        var div = $("#msg_history");
                        div.scrollTop(div.prop('scrollHeight'));
                        callAPIChat();
                        break;
                    default:
                        Swal.fire({title: 'Success', text: data.msg, icon: 'success', showCancelButton: false, confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'});
                        break;
                }

            } else {

                // failed mycon
                switch (action)
                {
                    default :
                        Swal.fire({title: 'Warning', text: data.msg, icon: 'warning', showCancelButton: false, confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'});
                        break;

                }

            }
        },
        error: function (request, error) {
            Swal.fire({title: 'Error', text: error, icon: 'error', showCancelButton: false, confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'});

        }
    });
}

function busy(e, button)
{
    if (e) {
        $('body').css('cursor', 'wait');
    } else
        $('body').css('cursor', 'auto');

    if (e) {
        dump('busy loading');
        /*NProgress.set(0.0);		
         NProgress.inc(); */
        $(".main-preloader").show();
        if (!empty(button)) {
            button.css({'pointer-events': 'none'});
        }
    } else {
        dump('done loading');
        $(".main-preloader").hide();
        //NProgress.done();    	
        if (!empty(button)) {
            button.css({'pointer-events': 'auto'});
        }
    }
}

function nAlert(msg, alert_type)
{
    var n = noty({
        text: msg,
        type: alert_type,
        theme: 'relax',
        layout: 'topCenter',
        timeout: 3000,
        animation: {
            open: 'animated fadeInDown', // Animate.css class names
            close: 'animated fadeOut', // Animate.css class names	        
        }
    });
}



function clearFormElements(ele) {

    $(ele).find(':input').each(function () {
        switch (this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });

}




function scroll(id) {
    if ($(id)) {
        $('.content_main').animate({scrollTop: $(id).offset().top - 100}, 'slow');
    }
}


$(document).ready(function () {

    $(document).on("keyup", ".numeric_only", function () {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });


}); /*end docu*/