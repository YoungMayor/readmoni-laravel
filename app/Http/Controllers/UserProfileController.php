<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Providers\RouteServiceProvider as RSP;
use App\Tools\PaystackPay as PAY;
use App\Tools\ReadMoni as RM;
use App\User;
use App\UserBank;
use Intervention\Image\Facades\Image;

class UserProfileController extends Controller
{
    public function showProfile(){        
        $user = Auth::user();
        $bank = UserBank::where('user_key', $user->user_key)->first();

        return view(RSP::USER_PROFILE, [
            'user' => $user,
            'bank' => $bank
        ]);
    }

    public function showProfileEditor(){        
        $user = Auth::user();
        $bank = UserBank::where('user_key', $user->user_key)->first();

        return view(RSP::USER_PROFILE_EDIT, [
            'user' => $user,
            'bank' => $bank
        ]);
    }

    
    function changeAvatar(Request $request){
      $validateRule = [
        'avatar' => [
          'required', 
          'image', 
          'mimes:jpeg,jpg,png,svg,gif', 
          'max:2048', 
          'min:10'
        ]
      ];

        
      $validateMessages = [
        'avatar.required' => 'Select a file to use as your avatar',
        'avatar.image' => 'The file you uploaded is not a valid image, please review this',
        'avatar.mimes' => 'Invalid file selected',
        'avatar.min' => 'Please select a bigger image file',
        'avatar.max' => 'Your avatar should not exceed 2mb in size',
      ];

      $validatedData = Validator::make($request->all(), $validateRule, $validateMessages)->validate();

      $oldAvatar = Auth::user()->avatar;

      $avatarName = $request->file('avatar')->store('/', 'avatar');
      $avatarPath = Storage::disk('avatar')->path($avatarName);

      $img = Image::make($avatarPath);
      // $img->resize(640, 640, function ($constraint) {
      //   $constraint->aspectRatio();
      // })->save($avatarPath);
      $img->fit(640)->save($avatarPath);
        
      Storage::disk("avatar")->delete($oldAvatar);

      $user = User::updateOrCreate(
          ["id" => Auth::id()],
          ["avatar" => $avatarName]
      );
      return redirect()->back()->with(['avatar_succes' => 'New Avatar uploaded']);
    }

    public function updateNick(Request $request){
        $chatNameRegex = RM::CHAT_NAME_REGEX;

        $validateRule = [
            'nickname' => ['required', 'unique:users,chat_name', "regex:$chatNameRegex"]
          ];
      
          $validateMessages = [
            'nickname.required' => 'You must a enter a name to change to!',
            'nickname.unique' => 'The name you entered is not available!',
            'nickname.regex' => 'The name you entered is invalid. Valid names should contain only alphanumerals, hyphen(-), underscore(_) and fullstop(.). It should not contain spaces and must be more than 6 characters and less than 24 characters'
          ];
      
          $validator = Validator::make($request->all(), $validateRule, $validateMessages);
      
          if ($validator->fails()) {
            $error['e'] = view(RSP::ERROR_PLAIN, ["errors" => $validator->errors()])->render();
            return json_encode($error);
          }
          $validatedData = $validator->validate();

        $user = User::updateOrCreate(
            ['id' => Auth::id()], 
            ['chat_name' => $validatedData['nickname']]
        );
      
          $response['s'] = view(RSP::GOOD_PLAIN, ["message" => "Your chat name has been changed successfully"])->render();
      
          return json_encode($response);
    }

    public function updateName(Request $request){
        $validateRule = [
            'name' => ['required', 'string', "min:4", 'max:120']
          ];
      
          $validateMessages = [
            'name.required' => 'You must a enter a name to change to!',
            'name.string' => 'Invalid encoding on your name!',
            'name.min' => 'Name too short',
            'name.max' => 'Name exceeds maximum allowed characters of 120chars',
          ];
      
          $validator = Validator::make($request->all(), $validateRule, $validateMessages);
      
          if ($validator->fails()) {
            $error['e'] = view(RSP::ERROR_PLAIN, ["errors" => $validator->errors()])->render();
            return json_encode($error);
          }
          $validatedData = $validator->validate();

        $user = User::updateOrCreate(
            ['id' => Auth::id()], 
            ['full_name' => $validatedData['name']]
        );
      
          $response['s'] = view(RSP::GOOD_PLAIN, ["message" => "Your name has been changed successfully"])->render();
      
          return json_encode($response);
    }

    public function updatePhone(Request $request){
        $validateRule = [
            'phone' => ['required', 'string', "min:11", 'max:24']
          ];
      
          $validateMessages = [
            'phone.required' => 'Enter your phone number',
            'phone.string' => 'Invalid encoding on your phone number!',
            'phone.min' => 'Phone number length invalid',
            'phone.max' => 'Phone number length invalid',
          ];
      
          $validator = Validator::make($request->all(), $validateRule, $validateMessages);
      
          if ($validator->fails()) {
            $error['e'] = view(RSP::ERROR_PLAIN, ["errors" => $validator->errors()])->render();
            return json_encode($error);
          }
          $validatedData = $validator->validate();

        $user = User::updateOrCreate(
            ['id' => Auth::id()], 
            ['telephone' => $validatedData['phone']]
        );
      
          $response['s'] = view(RSP::GOOD_PLAIN, ["message" => "Phone number updated"])->render();
      
          return json_encode($response);
    }

    public function updateDOB(Request $request){
        $validateRule = [
            'dob' => ['required', 'date', "before:16 years ago"]
          ];
      
          $validateMessages = [
            'dob.required' => 'Enter your date of birth',
            'dob.date' => 'Invalid Date!',
            'dob.before' => 'You have to be at least 16 years of age to use this application',
          ];
      
          $validator = Validator::make($request->all(), $validateRule, $validateMessages);
      
          if ($validator->fails()) {
            $error['e'] = view(RSP::ERROR_PLAIN, ["errors" => $validator->errors()])->render();
            return json_encode($error);
          }
          $validatedData = $validator->validate();

        $user = User::updateOrCreate(
            ['id' => Auth::id()], 
            ['dob' => $validatedData['dob']]
        );
      
          $response['s'] = view(RSP::GOOD_PLAIN, ["message" => "Phone number updated"])->render();
      
          return json_encode($response);
    }

    public function updateSex(Request $request){
        $validateRule = [
            'gender' => ['required', Rule::in(['m', 'f', 'u'])]
          ];
      
          $validateMessages = [
            'gender.required' => "Please select a gender", 
            'gender.rule' => "Are you masculine, feminine or you don't want us to know? Whichever it is, just specify!", 
          ];
      
          $validator = Validator::make($request->all(), $validateRule, $validateMessages);
      
          if ($validator->fails()) {
            $error['e'] = view(RSP::ERROR_PLAIN, ["errors" => $validator->errors()])->render();
            return json_encode($error);
          }
          $validatedData = $validator->validate();

        $user = User::updateOrCreate(
            ['id' => Auth::id()], 
            ['sex' => $validatedData['gender']]
        );
      
          $response['s'] = view(RSP::GOOD_PLAIN, ["message" => "Gender Updated"])->render();
      
          return json_encode($response);
    }

    public function updateAddress(Request $request){
        $validateRule = [
          'address' => ['required', 'string', 'min:12', 'max:255']
          ];
      
          $validateMessages = [
            'address.required' => "Don't be afraid, we do not disclose your address to others. It will just be used for payouts confirmation", 
          ];
      
          $validator = Validator::make($request->all(), $validateRule, $validateMessages);
      
          if ($validator->fails()) {
            $error['e'] = view(RSP::ERROR_PLAIN, ["errors" => $validator->errors()])->render();
            return json_encode($error);
          }
          $validatedData = $validator->validate();

        $user = User::updateOrCreate(
            ['id' => Auth::id()], 
            ['address' => $validatedData['address']]
        );
      
          $response['s'] = view(RSP::GOOD_PLAIN, ["message" => "Address Updated"])->render();
      
          return json_encode($response);
    }

    public function updateBank(Request $request){
        $banks = PAY::getAllBanks();
      
        $validateRule = [
          'bank' => ['required', Rule::in($banks->pluck('short_name')->all())], 
          'name' => ['required', 'string', 'min:5', 'max:255'], 
          'number' => ['required', 'numeric', 'digits_between:7,32'], 
        ];
      
        $validateMessages = [
          'bank.required' => 'Please select a bank', 
          'bank.rule' => 'Select a bank from the given list.', 

          'name.required' => 'The Account name is required', 
          'name.min' => 'Account Name too short, please review', 
          'name.max' => 'Account Name too long, please review', 

          'number.required' => 'The Account Number is required', 
          'number.numeric' => 'Account number should be a number', 
          'number.digits_between' => 'Account number verification failed', 
        ];
      
        $validator = Validator::make($request->all(), $validateRule, $validateMessages);
    
        if ($validator->fails()) {
          $error['e'] = view(RSP::ERROR_PLAIN, ["errors" => $validator->errors()])->render();
          return json_encode($error);
        }
        $validatedData = $validator->validate();
        $accountNumber = $validatedData['number'];
        $bankObj = PAY::getBank($validatedData['bank']);
        $bankCode = $bankObj['short_code'];
        $bankName = $bankObj['full_name'];

        $verifiedBank = PAY::verifyAccount($accountNumber, $bankCode);

        if (!$verifiedBank){
          $error['e'] = view(RSP::ERROR_MESSAGE, ['message' => "Bank Details not correct. Please verify"])->render();
          return json_encode($error);
        }

        $accountName = $verifiedBank['name'];
        $user = Auth::user();
        $userKey = $user->user_key;

        $recipientName = "User $userKey - $accountName";
        $recipientDescription = "Bank Account Details for $userKey - Account Name: $accountName - Account Number: $accountNumber | $bankName";
        
        $recipientCode = PAY::createRecipent($recipientName, $accountNumber, $recipientDescription, $bankCode);

        $userBank = UserBank::updateOrCreate(
            [
              'user_key' => Auth::user()->user_key
            ], [
              'bank_name' => $bankObj['full_name'],
              'account_name' => $verifiedBank['name'],
              'account_number' => $verifiedBank['number'],
              'bank_code' => $validatedData['bank'], 
              'recipient_code' => $recipientCode
            ]
        );

        UserNotificationController::BankChange(Auth::id());
      
        $response['s'] = view(RSP::GOOD_PLAIN, ["message" => "Account Info has been updated"])->render();
    
        return json_encode($response);
    }
}
