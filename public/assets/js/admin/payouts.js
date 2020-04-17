function Payouts(){
    var bar = this;

    this.card = RM.toDOMElement('\
<div class="row align-items-center border-bottom pb-2 pt-2">\
    <div class="col">\
        <div class="custom-control custom-checkbox">\
            <input class="custom-control-input mass_payout" type="checkbox" id="" value="" data-amt="" name="mass_payout[]" />\
            <label class="custom-control-label mass_payout_label" for="">\
                <span class="user_key"></span>\
                <strong class="user_name"></strong>\
            </label>\
        </div>\
    </div>\
\
    <div class="col-auto">\
        &#x20A6;<span class="amount"></span>\
    </div>\
\
    <div class="col-auto">\
        <div class="btn-group" role="group">\
            <a class="btn btn-outline-info btn-sm mr-2 audit_link" role="button" href="" target="_blank">\
                Audit\
            </a>\
\
            <button class="btn btn-success btn-sm btn-icon-split pay_user" data-reqid="" role="button">\
                <span class="text-white-50 icon">\
                    <i class="fas fa-dollar-sign"></i>\
                </span>\
                <span class="text-white text">Pay</span>\
            </button>\
        </div>\
    </div>\
</div>\
');

    this.makeMarkup = function(elem){
        var thisTemplate = $(bar.card).clone();

        $(thisTemplate).find('.mass_payout')
                .attr('id', 'request-'+elem.rid)
                .attr('data-amt', elem.csh_rw)
                .val(elem.rid);
        $(thisTemplate).find('.mass_payout_label')
                .attr('for', 'request-'+elem.rid);
        $(thisTemplate).find('.user_key').html(elem.key);
        $(thisTemplate).find('.user_name').html(elem.nme);
        $(thisTemplate).find('.amount').html(elem.csh_fm);
        $(thisTemplate).find('.audit_link').attr('href', elem.aud);
        $(thisTemplate).find('.pay_user').attr('data-reqid', elem.rid);
        
        return thisTemplate;
    };

    this.getRequests = function(btn){
        var thisBTN = $(btn); 
        if ($(thisBTN).attr('data-loading') == 'true'){
            return false;
        }
        var thisURL = $(thisBTN).attr("data-url");
        var thisPage = $(thisBTN).attr('data-page');

        var thisTarget = $("#payout_requests");

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

    this.multiPay = function(){
        
    }


    this.loadStart = function(btn){
        $(btn).append($(loadingICON).clone());
        $(btn).attr('data-loading', 'true');
    }

    this.loadStop = function(btn){
        $(btn).removeAttr('data-loading'); 
        $(btn).find('.loading-icon').remove();
    }
}

let PAYOUTS = new Payouts();

$("#load-requests").on('click', function(){
    PAYOUTS.getRequests(this);
});

