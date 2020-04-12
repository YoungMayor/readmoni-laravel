var notifAlertWrapper = document.createElement('div');
notifAlertWrapper.innerHTML = '\
<div class="row no-gutters notification-card p-1 border-bottom">\
    <div class="col-auto notification-icon-col">\
        <i class="border rounded-circle fa-3x p-2 text-white notification-icon"></i>\
    </div>\
\
    <div class="col notification-detail-col p-1">\
        <div>\
            <span class="small notification-text"></span>\
        </div>\
        <div class="text-right small">\
            <small class="font-weight-bold font-italic notification-date"></small>\
        </div>\
    </div>\
</div>\
';
var notifAlertTemplate = notifAlertWrapper.firstChild;

var notifAlertLoadingWrapper = document.createElement('div'); 
notifAlertLoadingWrapper.innerHTML = '<i class="fa fa-spin fa-spinner loading-icon"></i>';
var notifAlertLoadingTemplate = notifAlertLoadingWrapper.firstChild;


function parseAlertCard(elem){
    var thisTemplate = $(notifAlertTemplate).clone();

    $(thisTemplate).find('.notification-text').html(elem.nt);
    var thisClass = notificationsIconMap[elem.cat]
    $(thisTemplate).find(".notification-icon").addClass(thisClass);
    if (elem.ur){
        $(thisTemplate).addClass('unread-alert');
    }
    $(thisTemplate).find('.notification-date').html(elem.dt);
    return thisTemplate;
}

$("#load-alert-center").one('click', function(){
    getAlerts(this);
});

$("#load-notifications").on('click', function(){
    getAlerts(this);
});


function getAlerts(btn) {

    var thisBTN = $(btn); 
    if ($(thisBTN).attr('data-loading') == 'true'){
        return false;
    }
    var thisURL = $(thisBTN).attr("data-url");
    var thisPage = $(thisBTN).attr('data-page');

    var thisTarget = $($(thisBTN).attr('data-store'));

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
        }
    });

    $.ajax({
        method: "POST",
        url: thisURL,
        data: {
            page: thisPage
        },
        dataType: "JSON",
        beforeSend: function() {
            alertLoadingStart(thisBTN);
        },
        complete: function() {
            alertLoadingStop(thisBTN);
        },
        error: function() {
//             $(thisError).html("There was an error with your request");
        },
        statusCode: {
            419: function() {
                location.reload();
            },
        },
        success: function(response) {
            if (response.list){
                for (var i in response.list){
                    var thisElem = response.list[i];
                    var markup = parseAlertCard(thisElem);
                    $(thisTarget).append(markup);
                }
            }
            $(thisBTN).attr('data-page', response.next);
        },
    });
}

function alertLoadingStart(btn){
    $(btn).append($(notifAlertLoadingTemplate).clone());
    $(btn).attr('data-loading', 'true');
}

function alertLoadingStop(btn){
    $(btn).removeAttr('data-loading'); 
    $(btn).find('.loading-icon').remove();
}
