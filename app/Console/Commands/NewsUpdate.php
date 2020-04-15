<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Request;

class NewsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the news library';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Request $request){
        $news = new NewsController(); 
        $news->retrieveNews();
    }
}
