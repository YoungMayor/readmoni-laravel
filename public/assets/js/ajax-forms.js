$(".full_ajform").on("submit", function(e) {
    e.preventDefault();

    var thisForm = $(this)[0]
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
            ajLoaderStart(thisForm);
            $(thisResponses).html('');
        },
        complete: function() {
            ajLoaderStop(thisForm);
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
});

function ajLoaderStart(elem){
    var submitButton = $(elem).find('.aj-submit-btn'); 
    var loadingIconContainer = $(submitButton).find('.aj-loading-icon');
    var loadingIcon = $(loadingIconContainer).children().first();

    $(submitButton).attr('disabled', 'true');
    $(loadingIcon).removeClass().addClass('fa fa-spin fa-spinner');
}

function ajLoaderStop(elem){
    var submitButton = $(elem).find('.aj-submit-btn'); 
    var loadingIconContainer = $(submitButton).find('.aj-loading-icon');
    var loadingIcon = $(loadingIconContainer).children().first();

    $(submitButton).removeAttr('disabled');
    $(loadingIcon).removeClass().addClass('fas fa-check');
}
