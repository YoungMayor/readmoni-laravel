$(function(){
   $(".switch_category").first().click(); 
});

var newsCardWrapper = document.createElement('div');
newsCardWrapper.innerHTML = '\
<div class="row news-card mb-3 p-2 shadow-sm rounded">\
    <div class="col news-details p-0">\
        <a class="text-left btn p-0 news-link" href="" target="_blank">\
            <h4 class="text-dark font-weight-bold news-title"></h4>\
            <p class="font-italic small news-preview"></p>\
        </a>\
    </div>\
\
    <div class="col-4 news-image"></div>\
</div>';
var newsCardTemplate = newsCardWrapper.firstChild;


var newsCategoryLoadingWrapper = document.createElement('div'); 
newsCategoryLoadingWrapper.innerHTML = '<i class="fa fa-spin fa-spinner loading-icon"></i>';
var newsCategoryLoadingTemplate = newsCategoryLoadingWrapper.firstChild;

function parseNewsCard(elem){
    var thisTemplate = $(newsCardTemplate).clone();
    $(thisTemplate).find('.news-link').attr('href', elem.url);
    $(thisTemplate).find('.news-title').html(elem.tt);
    $(thisTemplate).find('.news-preview').html(elem.prv); 
    $(thisTemplate).find('.news-image').css('backgroundImage', "url('"+elem.img+"')");

    return $(thisTemplate);
}

$(".switch_category").click(function(){
    var thisBTN = $(this); 
    var thisCat = $(thisBTN).attr('data-cat');
    var thisPage = $(thisBTN).attr('data-page');

    var thisTarget = prepareNewsTarget(thisCat);

    $(".news_container").fadeOut(300);
    $(thisTarget).fadeIn(300);

    $(".switch_category").removeClass("active_category"); 
    $(thisBTN).addClass("active_category");
    if (Number(thisPage) < 1){
        $("#get_news").click();
    }
});


$("#get_news").on("click", function(e) {
    e.preventDefault();

    var thisBTN = $(".switch_category.active_category"); 
    if ($(thisBTN).attr('data-loading') == 'true'){
        return false;
    }
    var thisURL = $(thisBTN).parent("#news-category-ctrl").attr("data-target");
    var thisCat = $(thisBTN).attr('data-cat');
    var thisPage = $(thisBTN).attr('data-page');

    var thisTarget = prepareNewsTarget(thisCat);

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
        }
    });

    $.ajax({
        method: "POST",
        url: thisURL,
        data: {
            category: thisCat,
            page: thisPage
        },
        dataType: "JSON",
        beforeSend: function() {
            newsLoadingStart(thisBTN);
        },
        complete: function() {
            newsLoadingStop(thisBTN);
        },
        error: function() {
//             $(thisError).html("There was an error with your request");
        },
        success: function(response) {
            if (response.list){
                for (var i in response.list){
                    var thisElem = response.list[i];
                    var markup = parseNewsCard(thisElem);
                    $(thisTarget).append(markup);
                }
            }
            $(thisBTN).attr('data-page', response.next);
        },
    });
});

function prepareNewsTarget(category){
    if ($("#news_container_"+category).length < 1){
        var container = document.createElement("div"); 
        $(container).attr("id", "news_container_"+category);
        $(container).addClass("news_container");
        $("#news-list").append(container);
    }
    return $("#news_container_"+category);
}

function newsLoadingStart(btn){
    $(btn).append($(newsCategoryLoadingTemplate).clone());
    $(btn).attr('data-loading', 'true');
}

function newsLoadingStop(btn){
    $(btn).removeAttr('data-loading'); 
    $(btn).find('.loading-icon').remove();
}
