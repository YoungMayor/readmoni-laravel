<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider as RSP;
use Illuminate\Http\Request;
use App\User;
use App\UserBank;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view(RSP::USER_REGISTER);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name' => ['required', 'string', 'max:240'],
            'chat_name' => ['required', 'string', 'min:4', 'max:24', 'regex:/^[A-z][A-z0-9\.\_]{3,23}$/', 'unique:users,chat_name'],
            'address' => ['required', 'string', 'min:12', 'max:255'],
            'telephone' => ['required', 'string', 'min:11', 'max:14'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'email'],
            'dob' => ['required', 'date', 'before:16 years ago'],
            'gender' => ['required', Rule::in(['m', 'f', 'u'])],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'referer' => ['nullable', 'string', 'regex:/^[A-z]{2}-[0-9]{4}[A-z]$/i'], 
            'tnc' => ['required']
        ], [
            'full_name.required' => "Please tell us your name", 
            'full_name.string' => "We do not understand the name you gave", 
            'full_name' => "You don't expect us to believe your name is that long. Do you?", 
            'chat_name.required' => "You will need a unique chat name. Trust me, you would!", 
            'chat_name.string' => "We do not understand the chat name you gave", 
            'chat_name.min' => "Your chat name should be more than 4 characters", 
            'chat_name.max' => "That chat name is too long", 
            'chat_name.regex' => "Read the guidelines as to creating a chat name", 
            'chat_name.unique' => 'That chat name looks nice. But someone else is already using it, try another!', 
            'address.required' => "Don't be afraid, we do not disclose your address to others. It will just be used for payouts confirmation", 
            'telephone.required' => "A valid phone number is required", 
            'email.required' => "Your email address would be used for password recovery, login and payout notifications. It is neccessary!", 
            'email.unique' => "An account has already been registered with that email address. Check again to verify its correct, or try login in!", 
            'email' => "The given email is not valid", 
            'dob.required' => "Enter your date of birth", 
            'dob.date' => "Invalid date", 
            'dob.before' => "You have to be at least 16years to use this application", 
            'gender' => "Are you masculine, feminine or you don't want us to know? Whichever it is, just specify!", 
            'password.required' => "Seriously? Everyone knows you need a password", 
            'password.string' => "Invalid password", 
            'password.min' => "Password way too short.", 
            'password.confirmed' => "Passwords do not match", 
            'referer' => "Invalid referer key", 
            'tnc' => "Please read and accept the terms and condition of use before you can create your account."
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $userKey = self::createKey();

        return User::create([
            'user_key' => $userKey,
            'full_name' => $data['full_name'],
            'chat_name' => $data['chat_name'],
            'email' => $data['email'],
            'telephone' => $data['telephone'], 
            'address' => $data['address'], 
            'dob' => $data['dob'], 
            'sex' => $data['gender'], 
            'account_activated' => 'n',
            'referer' => $data['referer'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $user = UserBank::updateOrCreate(
            ["user_key" => $user->user_key],
            ["account_name" => $user->full_name]
        );
    }

    protected function redirectTo(){
        return route('user.activate.page', [
            'key' => Auth::user()->user_key
        ]);
    }

    protected static function createKey(){
        $allAlphas = "ABCDEFGHJKLMNPQRSTUVWXYZ";
        $shuffled = str_shuffle($allAlphas);
        $firstTwoLetters = substr($shuffled, 0, 2);
        $lastLetter = substr($shuffled, -1);
        $btwNos = str_pad(rand(100, 9999), 4, 0, STR_PAD_LEFT);

        $generatedKey = $firstTwoLetters . "-" . $btwNos . $lastLetter;
        $user = User::where("user_key", $generatedKey)->first();

        if ($user) {
            return self::createKey();
        } else {
            return $generatedKey;
        }
    }
}
