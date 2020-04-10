<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    protected $news_categories = [
        "business",
        "entertainment",
        "general",
        "health",
        "science",
        "sports",
        "technology"
    ];

    public function retrieveNews(){
        $timeLimit = date("Y-m-d H:i:s", strtotime('2 days ago'));

        News::where('created_at', '<', $timeLimit)->delete();
        foreach ($this->news_categories AS $category) {
            $results = $this->getNews($category);
            $articles = $results['articles'];
            $this->saveToDB($category, $articles);
            // sleep(3);
        }
        $breakingNewsResults = $this->getNews();
        $breakingNewsArticles = $breakingNewsResults['articles'];
        
        $this->saveToDB("breaking-news", $breakingNewsArticles);
    }

    public function getNews($category = false){
        if (!$category){ 
            $category = "top-news";
        }
        $url = $this->getNewsURL($category);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        $results = json_decode(curl_exec($ch), true);
        return $results;
    }

    protected function getNewsURL($category){
        $src = config('app.NEWS_SOURCE', 'CACHE'); 
        switch ($src) {
            case 'LIVE':
                $apiKey = config('app.NEWS_API_KEY');
                $url = "https://newsapi.org/v2/top-headlines?country=ng{$category}&pageSize=100&apiKey=$apiKey";
                break;
            
            case 'CACHE':
            default:
                $apiKey = config('app.NEWS_API_KEY');
                $url = url("/newscache/$category.json");
                break;
        }
        return $url;
    }

    protected function saveToDB($cat, $articles){
        $n = 1;
        foreach ($articles AS $article){
            $preview = preg_replace("/^(.{0,260})(.*)$/", '$1...', $article['content']);

            $news = new News; 
            $news->category = strtolower($cat); 
            $news->title = $article['title']; 
            $news->source = $article['source']['name'];
            $news->url = $article['url']; 
            $news->image = $article['urlToImage'] ?? asset('assets/img/readmoni.png');
            $news->preview = preg_replace("/^(.{0,26})(.*)$/", '$1...', $article['content']);
            $news->hash = sha1(uniqid().time()).$n;
            $news->save();
            $n++;
        }
    }
}
