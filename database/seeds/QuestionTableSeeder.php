<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create([
            'name' => 'System Generated', 
            'email' => 'systemgenerated', 
            'question' => 'What is ReadMONI', 
            'answer' => 'ReadMONI is an application that pays you for reading news and articles'
        ]);
        Question::create([
            'name' => 'System Generated', 
            'email' => 'systemgenerated', 
            'question' => 'How soon can i withdraw?', 
            'answer' => 'As soon as your balance crosses the set threshold'
        ]);
        Question::create([
            'name' => 'System Generated', 
            'email' => 'systemgenerated', 
            'question' => 'Where will my cash be paid to', 
            'answer' => 'Your cash would be paid to the account details stated in your account profile (bank section) we strongly advice that you verify the values given there, as we will not be held responsible for issues arising from payments unto wrong accounts'
        ]);
    }
}
