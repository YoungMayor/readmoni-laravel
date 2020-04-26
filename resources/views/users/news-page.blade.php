@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")
@css(news-list)
@endsection

@section("page-js")
@js(news-list)
@endsection

@section('page-body-class', "pl-0 pr-0")

@section("page-body")

<script>
    const NEWS_CATEGORIES = @json($categories);
</script>

<div id="news-app">
    <div class="bg-white shadow d-flex h-list" id="news-category-ctrl" data-target="{{ route('user.news.load') }}">
        <button class="btn btn-outline-secondary btn-sm m-2 switch_category" :class="{active_category: activeCategory == elem.key, inactive_category: activeCategory != elem.key}" :data-cat="elem['key']" :data-page="elem['page']" type="button" v-for="elem in categories" @click="switchCategory(elem['key'])">
            <span>
                @{{ elem.label }}
            </span>
            <span v-if="elem.isLoading">
                <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
            </span>
        </button>
    </div>

    <div id="news-list" class="p-3">
        <div class="news_container" :id="'news_container_'+elem.key" v-for="elem in categories" :class="{active_category: activeCategory == elem.key, inactive_category: activeCategory != elem.key}">

            <div class="row news-card mb-3 p-2 shadow-sm rounded" v-for="news_item in elem.news">
                <div class="col news-details p-0">
                    <a class="text-left btn p-0 news-link" :href="news_item.url" target="_blank">
                        <h4 class="text-dark font-weight-bold news-title">
                            @{{ news_item.tt }}
                        </h4>
                        <p class="font-italic small news-preview mb-0">
                            @{{ news_item.prv }}
                        </p>
                    </a>

                    <div class="d-flex justify-content-between">
                        <span class="text-right d-block small news-source">
                            @{{ news_item.src }}
                        </span>
                        
                        <span class="text-right small news-seen" v-if="news_item.seen">
                            <i class="far fa-eye"></i>
                        </span>
                        <small class="text-right small badge-success p-1 rounded shadow-sm" v-else>
                            NEW
                        </small>
                    </div>
                </div>

                <div class="col-4 news-image" :style="{backgroundImage: 'url(' + news_item.img + ')'}"></div>
            </div>

        </div>
    </div>
    
    <button id="get_news" class="btn btn-outline-secondary btn-sm m-auto d-block" type="button" @click="getNews">
        Load News
    </button>   
</div>

@endsection
