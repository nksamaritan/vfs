<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Validator;
use Auth;
use Hash;

class LoginController extends Controller
{

	 use AuthenticatesUsers;

	/**
     * Override login athentication method.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */

    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        if (!$request->isMethod('post')) {
            return response(["statusCode" => "0","message" => "404 Not found.","errors" => []], 404)->header('Content-Type', "json");
        }

	    $validator = Validator::make($request->all(), [
	    	'email' => 'required|email', 
	    	'password' => 'required',
	    ]); 

	    if ($validator->fails()) {
            return response(['statusCode' =>0,'errors' => $validator->errors()->all(),'message' => 'Failed']);
	    }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1,'designation' =>'employee']))
        {
            $userData = $this->user->updateUserTokens($request->all());
          
            if($userData){
                
                // Set Profile picture path
                $filepath = url('/') . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR;
                $userData->profile_photo = $filepath.$userData->profile_photo;
                
                return response(['statusCode' =>1,'data' => $userData,'message' => 'Login Successfully...']);
            }
        }
        return response(['statusCode' =>0,'message' => "Your email and password don't match. Please try again or use a different email to register."]);
    }

    /**
     * Update Password of logged in user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {

        $rules = ['old_password' => 'required|min:6|Different:new_password|max:15',
                    'new_password' => 'required|min:6|Same:confirm_password|max:15',
                    'confirm_password' => 'required|min:6|max:15'
                ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response(['statusCode' =>0,'errors' => $validator->errors()->all(),'message' => 'Failed']);
        }

        $user = User::find($request->user_id);

        if (Hash::check($request->old_password, $user->password)) {

        	$updateUser = $this->user->updateChangePassword($request->all());

        	if ($updateUser) {
	            return response(['statusCode' =>1,'message' => 'Your password changed successfully.']);
	        }
            return response(['statusCode' =>0,'message' => 'Your password changed not successfully please try again.']);
        }
        return response(['statusCode' =>0,'message' => 'Sorry, your old password does not match. Please enter correct password and try again.']);
        
     }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $rules = ['email' => 'required|email'];

    	$validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response(['statusCode' =>0,'errors' => $validator->errors()->all(),'message' => 'Failed']);
        }
        
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        if ($response === Password::RESET_LINK_SENT) {
            return response(['statusCode' =>1,'message' => 'A link is sent on your email id. You will be able to create a new password using that link.']);
        }

        return response(['statusCode' =>0,'message' => 'System could not find this email id. Please enter correct email id and try again.']);
    }

    public function afterResetPassword()
    {
        return view('success');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }
}
