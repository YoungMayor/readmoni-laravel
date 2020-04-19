<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Blade;

class ViewShares extends ServiceProvider
{
    protected $cssPATH = "assets/css";
    protected $jsPATH = "assets/js";
    protected $imgPATH = "assets/img";
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::directive("BS_CSS", function($expression){
            return "<link rel='stylesheet' href='{{ asset('assets/bootstrap/css/bootstrap.min.css') }}'>";
        });


        Blade::directive("FAW_ALL", function($expression){
            return <<<_HTML_
<link rel='stylesheet' href='{{ asset('assets/fonts/fontawesome-all.min.css') }}'>
<link rel='stylesheet' href='{{ asset('assets/fonts/font-awesome.min.css') }}'>
<link rel='stylesheet' href='{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}'>
_HTML_;
        });


        Blade::directive("JQUERY", function($expression){
            return "<script src='{{ asset('assets/js/jquery.min.js') }}'></script>";
        });


        Blade::directive("BS_JS", function($expression){
            return "<script src='{{ asset('assets/bootstrap/js/bootstrap.min.js') }}'></script>";
        });


        Blade::directive("Vue_JS", function($expression){
            return "<script src='{{ asset('assets/js/Vue.js') }}'></script>";
        });


        Blade::directive("js", function($expression){
            $this->assetVersion($expression, $file, $version);

            $path = asset("$this->jsPATH/$file.js?v=$version");

            return "<script src='$path'></script>";
        });


        Blade::directive("css", function($expression){
            $this->assetVersion($expression, $file, $version);

            $path = asset("$this->cssPATH/$file.css?v=$version");

            return "<link rel='stylesheet' href='$path'>";
        });


        Blade::directive("imgURL", function($expression){
            return asset("$this->imgPATH/$expression");
        });

        Blade::directive("date", function($expression){
            return "<?php echo date('F d, Y', strtotime($expression)); ?>";
        });

        Blade::directive("aj_submit", function($expression){
            return <<<HTML_
            <!-- Start: Split Button Success -->
            <button class="btn btn-success btn-icon-split d-block ml-auto aj-submit-btn" type="submit">
                <span class="text-white-50 icon aj-loading-icon">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text-white text">$expression</span>
            </button>
            <!-- End: Split Button Success -->
HTML_;
        });

        Blade::directive("aj_response", function(){
            return <<<HTML_
            <div class="text-right text-danger">
                <small class="aj_response aj_error"></small>
            </div>
            <div class="text-right text-success">
                <small class="aj_response aj_success"></small>
            </div>
HTML_;
        });

        Blade::if('role', function($expression){
            return Auth::user()->role == $expression;
        });

        Blade::if('isOwner',function(){
            return in_array(Auth::user()->role, ['owner']);
        });

        Blade::if('isAdmin',function(){
            return in_array(Auth::user()->role, ['owner', 'admin']);
        });
    }

    protected function assetVersion($str, &$fileName = "", &$version = 1){
        $lis = explode(",", $str);
        
        $fileName = isset($lis[0])  ? trim($lis[0]) : "general";
        $version = isset($lis[1]) ? trim($lis[1]) : "1";
    }
}
