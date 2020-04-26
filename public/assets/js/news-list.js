$(function() {
    $(".switch_category").first().click();
});

_NEWS_CATEGORIES = {};

for (const key in NEWS_CATEGORIES) {
    _NEWS_CATEGORIES[key] = {
        'page': 0,
        'key': key,
        'label': NEWS_CATEGORIES[key],
        'news': [],
        'isLoading': false,
    };
}

var NEWSAPP = new Vue({
    el: "#news-app",

    data: {
        categories: _NEWS_CATEGORIES,
        targetURL: "",
        activeCategory: "",
    },

    methods: {
        switchCategory(category) {
            this.activeCategory = category;
        },
        getNews() {
            var thisCatObj = this.categories[this.activeCategory];

            if (thisCatObj.isLoading === true) {
                return;
            }
            thisCatObj.isLoading = true;

            var thisURL = $("#news-category-ctrl").attr("data-target");

            return axios.post(thisURL, {
                category: thisCatObj.key,
                page: thisCatObj.page,
            }).then(function(response) {
                var data = response.data;
                if (data.list) {
                    thisCatObj.news = thisCatObj.news.concat(data.list);
                }
                thisCatObj.page = data.next;
            }).catch(function(error) {
                if (error.response.status == '419') {
                    location.reload();
                }
            }).then(function() {
                thisCatObj.isLoading = false;
            })
        }
    },

    created: function() {}
});