<?php

namespace App\Http\Controllers;

use App\Helper\JwtToken;
use App\Http\Requests\ForgotPasswordOtpCheckSendRequest;
use App\Http\Requests\ForgotPasswordOtpSendRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrerRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Resources\UserResource;
use App\Mail\SendOtpMail;
use App\Models\Otp;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{   
    // রেজিস্ট্রেশন পেজ রেন্ডার করা
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    // Axios এর ডাটা রিসিভ ও ডাটাবেজে সেভ করা
    public function register(RegistrerRequest $request)
    {
        $validated = $request->validated();
        $userData = Arr::only($validated, ['name', 'email', 'outlet', 'password']);
        $profileData = Arr::only($validated, ['phone', 'address']);

        DB::beginTransaction();
        try {
            $user = User::create($userData);
            $profileData['user_id'] = $user->id;
            if ($request->hasFile('avatar')) {
                $path = $request->file('avatar')->store('avatars', 'public');
                $profileData['avatar'] = $path;
            } else {
                $profileData['avatar'] = null; // কোনো ছবি না দিলে ডিফল্ট নাল যাবে
            }
            Profile::create($profileData);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Registration completed successfully! Welcome to Shwapno POS.',
                'data'    => $user
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, please try again. to save in database',
            ], 500);
        }
    }
    
    public function loing(LoginRequest $request)
    {
        try {
            $user = User::whereEmail($request->email)->first();            
            if(!Hash::check($request->password, $user->password)){
                return response()->json([
                    'status' => true,
                    'errors' => ['Invalid Credentials'],
                ], 401);
            }
            $userData =[
                'email' => $user->email, 
                'id' => $user->id,
                'role' => $user->role,
                'avatar' => $user->profile->avatar_url,
            ]; 
            $exp = time() + 3600*24;            
            $token = JwtToken::createToken($userData, $exp);

            return response()->json([
                'status' => true,
                'message' => 'Login Success',
                'data' => new UserResource($user),
            ], 200)->cookie('userToken', $token['token'], $exp);
        } catch (\Exception $e) {
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, please try again later',
            ], 500);
        }
    }   


    public function showForgot()
    {
        return view('auth.forgot');
    }
    public function forgot(ForgotPasswordOtpSendRequest $request)
    {
        try {
            $otp = mt_rand(100000, 999999);
            Otp::create([
                'email' => $request->email,
                'otp' => $otp,
            ]);
            // SendOtpMail does not accept constructor arguments, instantiate without params
            Mail::to($request->email)->send(new SendOtpMail($otp));
            // Artisan::call('queue:work', ['--once' => true]);
            return response()->json([
                'success' => true,
                'message' => 'OTP sent to our email successfully',
            ], 201);
        }catch(\Exception $e){
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong, please try again later',
            ], 500);
        }
    }
    public function verifyOTP()
    {
        return view('auth.verifyotp');
    }
    public function verifyOTPCheck(ForgotPasswordOtpCheckSendRequest $request)
    {
        try {
            Otp::where('email', $request->email)
                ->where('otp', $request->otp)
                ->update(['status' => true]);

            $exp = time() + 900;
            /** @var array $token */
            $token = JwtToken::createToken(['email' => $request->email], $exp);
            return response()->json([
                'status' => true,
                'message' => 'OTP verified successfully',
            ], 200)->cookie('resetPasswordToken', $token['token'], $exp);
        
        }catch(\Exception $e){
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, please try again later and later',
            ], 500);
        }
        
    }


    public function showPasswordReset()
    {
        return view('auth.showpasswordreset');
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            if(!$request->cookie('resetPasswordToken')){
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong, please try again later',
                ], 200);
            }else{
                $decoded = JwtToken::verifyToken($request->cookie('resetPasswordToken'));
                if($decoded['error']){
                    return response()->json([
                        'status' => false,
                        'message' => 'Something went wrong, please try again later',
                    ], 422);
                }else{
                    $user = User::where('email', $decoded['payload']->email)->first();
                    // $user = User::whereEmail($decoded['payload']->email)->first();
                    $user->password = $request->password;
                    $user->save();
                    return response()->json([
                        'status' => true,
                        'message' => 'Password reset successfully',
                    ], 200)->withoutCookie('resetPasswordToken');
                }
            }

        }catch(\Exception $e){
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json([
                'status' => false,
                'message' => 'Last Something went wrong, please try again later',
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        return response()->json([
            'status' => true,
            'message' => 'Logout Success',
        ], 200)->withoutCookie('userToken');
    }
}
