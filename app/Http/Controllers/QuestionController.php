<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider AS RSP;
use Illuminate\Http\Request;
use App\Question;

use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function showPage(Request $request){
        $questions = Question::whereNotNull('answer')->get();
        if (!$questions){
            //log no questions
        }
        return view(RSP::USER_FAQ, [
            'questions' => $questions
        ]);
    }

    public function getAnswer(Request $request){
        $question = Question::find($request->question); 

        if (!$question){
            return false;
        }

        return $question->answer;
    }

    function askQuestion(Request $request){
        $validateRule = [
            'name' => ['required', 'string', 'max:255'], 
            'email'=> ['required', 'email'], 
            'question' => ['required', 'string', 'max:1024', 'unique:questions,question']
        ];
    
        $validateMessages = [
            'name.required' => 'Pleas enter your name!', 
            'email.required' => 'Enter an email address to be notified when an answer is given to your question', 
            'question.unique' => 'The question is a duplicate of a previously asked question'
        ];
    
        $validator = Validator::make($request->all(), $validateRule, $validateMessages);
    
        if ($validator->fails()) {
        $error['e'] = view(RSP::ERROR_PLAIN, ["errors" => $validator->errors()])->render();
        return json_encode($error);
        }
        $validatedData = $validator->validate();

        $question = Question::create([
            'name' => $request->name, 
            'email' => $request->email, 
            'question' => $request->question
        ]);
      
          $response['s'] = view(RSP::GOOD_PLAIN, ["message" => "We have received your requestion. A notification would be sent to {$request->email} when an answer has been supplied"])->render();
      
          return json_encode($response);
    }
}
