function faq(){
    var bar = this;

    this.targetURL = $("#faq-head").attr('data-url');

    this.getAnswer = function(btn){
        var thisBTN = $(btn); 

        
        var questionID = $(thisBTN).attr('data-id');

        var thisQuestion = $(thisBTN).find('.faq-question');
        var thisTarget = $(thisBTN).find('.faq-answer');

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
            }
        });

        $.ajax({ 
            method: "POST",
            url: bar.targetURL,
            data: {
                question: questionID
            },
            dataType: "HTML",
            beforeSend: function() {
                bar.loadStart(thisQuestion);
            },
            complete: function() {
                bar.loadStop(thisQuestion);
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
                $(thisTarget).html(response);
//                 $(thisBTN).attr('data-page', response.next);
            },
        });
    };


    this.loadStart = function(thisQuestion){
        $(thisQuestion).append($(loadingICON).clone());
//         $(btn).attr('data-loading', 'true');
    }

    this.loadStop = function(thisQuestion){
//         $(btn).removeAttr('data-loading'); 
        $(thisQuestion).find('.loading-icon').remove();
    }
}

let FAQ = new faq();

$(".faq-card").one('click', function(){
    FAQ.getAnswer(this);
});
