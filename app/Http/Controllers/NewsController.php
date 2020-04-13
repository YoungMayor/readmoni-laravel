<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Providers\RouteServiceProvider as RSP;
use App\News;
use App\NewsRead;
use App\Balance;

use App\Http\Controllers\BalanceController;

class NewsController extends Controller
{
    public $news_categories = [
        "business" => "Business News",
        "entertainment" => "Entertainment News",
        "general" => "Highlights",
        "health" => "Health News",
        "science" => "Science News",
        "sports" => "Top News",
        "technology" => "Technology News", 
        "top-news" => "Latest News"
    ];

    public function retrieveNews(){
        $timeLimit = date("Y-m-d H:i:s", strtotime('2 days ago'));

        News::where('created_at', '<', $timeLimit)->delete();
        foreach ($this->news_categories AS $category => $label) {
            $results = $this->getNewsJSON($category);
            $articles = $results['articles'] ?? false;
            if ($articles){
                $this->saveToDB($category, $articles);
            }
            // sleep(3);
        }
    }

    public function getNewsJSON($category = false){
        if (!$category){ 
            return false;
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
                if ($category == "top-news"){
                    $catURL = "";
                }else{
                    $catURL = "&category=$category";
                }
                $url = "https://newsapi.org/v2/top-headlines?country=ng{$catURL}&pageSize=100&apiKey=$apiKey";
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

    public function showNewsPage(){
        return view(RSP::USER_NEWS, [
            'categories' => $this->news_categories
        ]);
    }

    public function loadNews(Request $request){
        $validateRule = [
            'category' => ['required', Rule::in(array_keys($this->news_categories))], 
            'page' => ['required', 'numeric']
        ];
      
        $validator = Validator::make($request->all(), $validateRule);
    
        if ($validator->fails()) {
            $error['e'] = view(RSP::ERROR_PLAIN, ["errors" => $validator->errors()])->render();
            return json_encode($error);
        }

        $newsObj = News::where('category', $request->category)->latest()->simplePaginate(10);

        $newsList = [];
        $count = 0;
        foreach($newsObj as $thisNews){
            $newsList[$count]['tt'] = $thisNews->title;
            $newsList[$count]['src'] = $thisNews->source ?? "...";
            $newsList[$count]['prv'] = $thisNews->preview;
            $newsList[$count]['img'] = $thisNews->image;
            $newsList[$count]['url'] = route('user.news.view', [
                'hash' => $thisNews->hash
            ]);
            if (self::hasBeenRead($thisNews->id, Auth::id())){
                $newsList[$count]['seen'] = 1;
            }
            $count++;
        }
        if ($newsList){
            $response['list'] = $newsList;
            $response['next'] = $newsObj->currentPage() + 1;
        }else{
            // return end of list command
            $response['next'] = $newsObj->currentPage();
            $response['list'] = [];
        }
        return json_encode($response);
    }

    public function viewNews($hash){
        $news = News::where('hash', $hash)->first(); 
        if (!$news){
            return redirect()->route('user.error.page')->with([
                'note' => "News Article unavailable", 
                'link' => route('user.news.page')
            ]);
        }

        $newsURL = $news->url;
        $newsID = $news->id;

        if (!self::hasBeenRead($newsID, Auth::id()) && self::withinReadLimit(Auth::id())){
            self::saveRead($newsID, Auth::id());
            BalanceController::readBonus(Auth::id());
        }

        return redirect($newsURL);
    }

    public static function hasBeenRead($newsID, $userID){
        return NewsRead::where('user_id', $userID)->where('news_id', $newsID)->first(); 
    }

    public static function saveRead($newsID, $userID){
        return NewsRead::create([
            'user_id' => $userID, 
            'news_id' => $newsID
        ]);                
    }

    public static function dailyReadCount($userID){
        return NewsRead::where('user_id', $userID)->whereDate('created_at', date('Y-m-d', strtotime('today')))->count() ?? 0;

    }

    public static function totalReadCount($userID){
        return NewsRead::where('user_id', $userID)->count() ?? 0;

    }

    public static function withinReadLimit($userID){
        return (self::dailyReadCount($userID) < config('app.DAILY_READ_LIMIT'));
    }
}
