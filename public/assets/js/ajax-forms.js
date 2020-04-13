function ajaxForm(){
    var bar = this;

    this.submitForm = function(thisForm){
        var thisForm = $(thisForm)[0]
        var thisFormTarget = $(thisForm).attr("action");

        var formData = new FormData(thisForm);

        var thisResponses = $(thisForm).find('.aj_response');
        var thisSuccess = $(thisForm).find('.aj_response.aj_success');
        var thisError = $(thisForm).find('.aj_response.aj_error');

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
            }
        });

        $.ajax({
            method: "POST",
            url: thisFormTarget,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            beforeSend: function() {
                bar.loadingStart(thisForm);
                $(thisResponses).html('');
            },
            complete: function() {
                bar.loadingStop(thisForm);
            },
            error: function() {
                $(thisError).html("There was an error with your request");
            },
            statusCode: {
                419: function() {
                    location.reload();
                },
            },
            success: function(response) {
                if (response.e) {
                    $(thisError).html(response.e);
                }

                if (response.s) {
                    $(thisSuccess).html(response.s);
                }
            },
        });
    }

    this.loadingStart = function(elem){
        var submitButton = $(elem).find('.aj-submit-btn'); 
        var loadingIconContainer = $(submitButton).find('.aj-loading-icon');
        var loadingIcon = $(loadingIconContainer).children().first();

        $(submitButton).attr('disabled', 'true');
        $(loadingIcon).removeClass().addClass('fa fa-spin fa-spinner');
    }

    this.loadingStop = function(elem){
        var submitButton = $(elem).find('.aj-submit-btn'); 
        var loadingIconContainer = $(submitButton).find('.aj-loading-icon');
        var loadingIcon = $(loadingIconContainer).children().first();

        $(submitButton).removeAttr('disabled');
        $(loadingIcon).removeClass().addClass('fas fa-check');
    }
}

let AJFORM = new ajaxForm();

$(".full_ajform").on("submit", function(e) {
    e.preventDefault(); 
    AJFORM.submitForm(this);
});

