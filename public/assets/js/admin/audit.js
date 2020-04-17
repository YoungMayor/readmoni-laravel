
function auditHistory(){
    var bar = this;

    this.card = RM.toDOMElement('\
<tr class="history-row">\
    <td class="date"></td>\
    <td class="name"></td>\
    <td class="text-right">\
        &#x20A6;<span class="amount"></span>\
    </td>\
</tr>\
');

    this.makeCard = function(elem){
        var thisTemplate = $(bar.card).clone();

        $(thisTemplate).addClass(elem.cls); 
        $(thisTemplate).find('.date').html(elem.dte);
        $(thisTemplate).find('.name').html(elem.nme);
        $(thisTemplate).find('.amount').html(elem.amt);

        return $(thisTemplate);
    }

    this.getHistory = function(btn){
        var thisBTN = $(btn); 

        if ($(thisBTN).attr('data-loading') == 'true'){
            return false;
        }

        var thisURL = $(thisBTN).attr("data-url");
        var thisFor = $(thisBTN).attr('data-for');
        var thisPage = $(thisBTN).attr('data-page');
        var thisType = $(thisBTN).attr('data-type');
        var thisTarget = $(thisBTN).attr('data-target');

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
            }
        });

        $.ajax({
            method: "POST",
            url: thisURL,
            data: {
                page: thisPage, 
                user: thisFor, 
                type: thisType
            },
            dataType: "JSON",
            beforeSend: function() {
                bar.loadStart(thisBTN);
            },
            complete: function() {
                bar.loadEnd(thisBTN);
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
                        var markup = bar.makeCard(thisElem);
                        $(thisTarget).append(markup);
                    }
                }
                $(thisBTN).attr('data-page', response.next);
            },
        });
    }


    this.loadStart = function(btn){
        $(btn).append($(loadingICON).clone());
        $(btn).attr('data-loading', 'true');
    }

    this.loadEnd = function(btn){
        $(btn).removeAttr('data-loading'); 
        $(btn).find('.loading-icon').remove();
    }
}

let AUDIT_HISTORY = new auditHistory();


$(".get-audit-history").click(function(){
    AUDIT_HISTORY.getHistory(this);
});
