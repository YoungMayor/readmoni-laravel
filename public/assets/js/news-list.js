$(function(){
   $(".switch_category").first().click(); 
});

function newsList(){
    var bar = this;

    this.card = RM.toDOMElement('\
<div class="row news-card mb-3 p-2 shadow-sm rounded">\
    <div class="col news-details p-0">\
        <a class="text-left btn p-0 news-link" href="" target="_blank">\
            <h4 class="text-dark font-weight-bold news-title"></h4>\
            <p class="font-italic small news-preview mb-0"></p>\
        </a>\
        <div class="d-flex justify-content-between">\
            <span class="text-right d-block small news-source">News Source Here</span>\
            <span class="text-right d-none small news-seen">\
                <i class="far fa-eye"></i>\
            </span>\
        </div>\
    </div>\
\
    <div class="col-4 news-image"></div>\
</div>');

    this.makeCard = function(elem){
        var thisTemplate = $(bar.card).clone();
        $(thisTemplate).find('.news-link').attr('href', elem.url);
        $(thisTemplate).find('.news-title').html(elem.tt);
        $(thisTemplate).find('.news-preview').html(elem.prv); 
        $(thisTemplate).find('.news-source').html(elem.src); 
        $(thisTemplate).find('.news-image').css('backgroundImage', "url('"+elem.img+"')");
        if (elem.seen){
            $(thisTemplate).find('.news-seen').removeClass('d-none');
        }

        return $(thisTemplate);
    }

    this.getNews = function(){
        var thisBTN = $(".switch_category.active_category"); 
        if ($(thisBTN).attr('data-loading') == 'true'){
            return false;
        }
        var thisURL = $(thisBTN).parent("#news-category-ctrl").attr("data-target");
        var thisCat = $(thisBTN).attr('data-cat');
        var thisPage = $(thisBTN).attr('data-page');

        var thisTarget = bar.prepareStorage(thisCat);

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

    this.switchCategory = function(thisBTN){
        var thisCat = $(thisBTN).attr('data-cat');
        var thisPage = $(thisBTN).attr('data-page');

        var thisTarget = bar.prepareStorage(thisCat);

        $(".news_container").fadeOut(300);
        $(thisTarget).fadeIn(300);

        $(".switch_category").removeClass("active_category"); 
        $(thisBTN).addClass("active_category");
        if (Number(thisPage) < 1){
            $("#get_news").click();
        }
    }

    this.prepareStorage = function(category){
        if ($("#news_container_"+category).length < 1){
            var container = document.createElement("div"); 
            $(container).attr("id", "news_container_"+category);
            $(container).addClass("news_container");
            $("#news-list").append(container);
        }
        return $("#news_container_"+category);
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

let NEWS = new newsList();


$(".switch_category").click(function(){
    NEWS.switchCategory(this);
});


$("#get_news").on("click", function() {
    NEWS.getNews();
});

