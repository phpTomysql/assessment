<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invitation;
use App\Mail\ConfirmInvitation;
use App\Mail\VerifyInvitation;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     *
     * invite function
     * param email string required
     * return json
     */
    

    public function invite(Request $request) {

        $validate = $request->validate(
            [
                'email' => 'required|email|unique:users,email'
            ]
        );

        try {
            $email = $request->email;

            $user = new User;

            $user->email = $email;

            $user->name = current(explode("@",$email));

            $user->password = \Hash::make(Str::random(10));

            $user->role = 'user';

            $user->invitation_token = \Hash::make(Str::random(32));

            $user->save();

            Mail::to($user->email)->send(new Invitation($user));

            return response()->json([
                'message'=>'Invitation sent',
                'error'=>false
            ],200);


        }catch(Exception $e) {

             return response()->json([
                'message'=>$e->getMessage(),
                'error'=>true
            ],400);

        }

    }

    /**
     *
     * acceptInvite function
     * param token string required
     * param username string required
     * param password string required
     * return json
     */
    
    public function acceptInvite(Request $request) {
        $validate = $request->validate(
            [
                'token' => 'required',
                'username'=>'required|min:4|max:20|unique:users,name',
                'password'=>'required'
            ]
        );

        try {

            $invitation_token = $request->token;
            $name = $request->username;
            $password = \Hash::make($request->password);

            $user = User::where('invitation_token' , $invitation_token)
            ->where('invitation_status','pending')
            ->first();

            if(!$user)  return response()->json([
                'message'=>'No related record found.',
                'error'=>true
             ],404);

            $pin = mt_rand(100000,999999);

            $user->invitation_status = 'accepted';
            $user->name = $name;
            $user->password = $password;
            $user->registered_at = \Carbon\Carbon::now();
            $user->pin = $pin;

            $user->save();

            $user->pin = $pin;

            Mail::to($user->email)->send(new VerifyInvitation($user));

            return response()->json([
                'message'=>'Woops you almost there.Verify pin.',
                'error'=>false
            ],200);

        }catch(Exception $e) {

              return response()->json([
                'message'=>$e->getMessage(),
                'error'=>true
             ],400);


        }

    }
    /**
     *
     * verify function
     * param username string required
     * param pin number required
     * return json
     *
     */
    
    public function verify(Request $request) {
       
        $validate = $request->validate(
            [
                'username'=>'required',
                'pin'=>'required'
            ]
        );

        $user = User::where('name',$request->username)
        ->where('pin',$request->pin)
        ->where('pin_status','pending')
        ->first();

        if(!$user) return response()->json([
                'message'=>'Invalid attempt.',
                'error'=>true
             ],404);


        $user->pin_status = 'completed';
        $user->save();

        Mail::to($user->email)->send(new ConfirmInvitation($user));

         return response()->json([
                'message'=>'Woops verification done. you can login now',
                'error'=>false
            ],200);


    }

    /**
     *
     * login function
     * param username string required
     * param password string required
     * return json
     *
     */
    
    public function login(Request $request) {
       
       $validate = $request->validate(
            [
                'username'=>'required',
                'password'=>'required'
            ]
        );


        $authParams = [
            'name'=>$request->username,
            'password'=>$request->password,
            'invitation_status'=>'accepted',
            'pin_status'=>'completed'
        ];

       if (Auth::attempt($authParams)) {

        $user = Auth::user();

         $token = $user->createToken('user')->plainTextToken;

         $data = [

            'username'=>$user->name,
            'email'=>$user->email,
            'token'=>$token
         ];

          return response()->json([
                'message'=>'Logged in',
                'error'=>false,
                'data'=>$data
            ],200);

       }else {

         return response()->json([
                'message'=>'Invalid attempt.',
                'error'=>true
             ],404);

       }
    }

    /**
     *
     * updateProfile function
     * param email string required
     * param username string required
     * param avatar file not required
     * return json
     */
    
    public function updateProfile(Request $request) {


        $fields = [
            
            'email' => 'required|email|unique:users,email,'.$request->user()->id,
            'username' => 'required|min:4|max:20|unique:users,name,'.$request->user()->id
            ];

        if ($request->hasFile('avatar')) {

            $fields['avatar'] = 'required|mimes:jpeg,bmp,png|dimensions:width=256,height=256';
   
        }

        $validate = $request->validate($fields);


        try {

            $user = User::findOrfail($request->user()->id);

            $avatarName = time().'.'.$request->avatar->extension();  
   
            $request->avatar->move(public_path('uploads'), $avatarName);

            $user->name = $request->username;

            $user->email = $request->email;

            $user->avatar = $avatarName;

            $user->save();

            return response()->json([
                'message'=>'Profile updated successfully.',
                'error'=>false,
            ],200);

        }catch(Exception $e) {

             return response()->json([
                'message'=>$e->getMessage(),
                'error'=>true
             ],404);

        }
    }
}
