<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider as RSP;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function showPage(){
        return view(RSP::ADMIN_FAQ);
    }

    public function getQuestions(){
        $question = Question::all();
        return $question;
    }

    public function saveQuestion(Request $request){
        $vRule = [
            'question' => ['required', 'string', 'min:12', 'max:255'],
            'answer' => ['nullable', 'string', 'max:255']
        ];

        $vMsg = [
            'question.required' => 'Enter a valid answer!', 
            'question.min' => 'Question too short!', 
            'question.max' => 'Question too long!', 

            'answer.required' => 'Enter a valid answer!', 
            'answer.min' => 'Answer too short!', 
            'answer.max' => 'Answer too long!', 
        ];

        $validator = Validator::make($request->all(), $vRule, $vMsg);

        if ($validator->fails()) {
            return [
                'error' => $validator->errors()
            ];
            return json_encode($validator->errors());

            $error['e'] = view(RSP::ERROR_PLAIN, ["errors" => $validator->errors()])->render();
            return json_encode($error);
        }

        switch ($request->key) {
            case 'new':
                return [
                    'created' => true,
                    'details' => Question::create([
                        'name' => Auth::user()->full_name, 
                        'email' => Auth::user()->email, 
                        'question' => $request->question,
                        'answer' => $request->answer
                    ])
                ];
                break;
            
            default:
                $faq = Question::updateOrCreate(
                    [
                        'id' => $request->key
                    ], 
                    [
                        'question' => $request->question, 
                        'answer' => $request->answer
                    ]
                );
                return [
                    'modified' => true, 
                    'details' => $faq
                ];
                break;
        }
    }

    public function deleteQuestion(Request $request){
        return false;
    }
}
