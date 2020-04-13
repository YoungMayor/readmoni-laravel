function alertCenter(){
    var bar = this;

    this.card = RM.toDOMElement('\
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
');

    this.makeMarkup = function(elem){
        var thisTemplate = $(bar.card).clone();

        $(thisTemplate).find('.notification-text').html(elem.nt);
        var thisClass = notificationsIconMap[elem.cat]
        $(thisTemplate).find(".notification-icon").addClass(thisClass);
        if (elem.ur){
            $(thisTemplate).addClass('unread-alert');
        }
        $(thisTemplate).find('.notification-date').html(elem.dt);
        return thisTemplate;
    };

    this.getAlerts = function(btn){
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
                bar.loadStart(thisBTN);
            },
            complete: function() {
                bar.loadStop(thisBTN);
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
                        var markup = bar.makeMarkup(thisElem);
                        $(thisTarget).append(markup);
                    }
                }
                $(thisBTN).attr('data-page', response.next);
            },
        });
    };


    this.loadStart = function(btn){
        $(btn).append($(loadingICON).clone());
        $(btn).attr('data-loading', 'true');
    }

    this.loadStop = function(btn){
        $(btn).removeAttr('data-loading'); 
        $(btn).find('.loading-icon').remove();
    }
}

let ALERTS = new alertCenter();

$("#load-alert-center").one('click', function(){
    ALERTS.getAlerts(this);
});

$("#load-notifications").on('click', function(){
    ALERTS.getAlerts(this);
});

