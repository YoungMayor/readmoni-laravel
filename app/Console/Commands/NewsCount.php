<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\NewsController;

class NewsCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        $controller = new NewsController;
        $categories = $controller->news_categories;
        $result = "";
        $totalCount = 0;

        $bar = $this->output->createProgressBar(count($categories));
        $this->line("Loading count of news in the database...");
        
        $bar->start();

        foreach($categories as $key => $val){
            $count = $controller->newsCount($key);
            
            $result .= "$val ($count)\r\n \r\n";
            $totalCount += $count;
            sleep(1);
            $bar->advance();
        }
        $bar->finish();
        $this->line(""); 
        $this->line($result);
        $this->line("Total Count of news ($totalCount)");
    }   
}
