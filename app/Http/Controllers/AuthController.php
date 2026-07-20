<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrerRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // রেজিস্ট্রেশন পেজ রেন্ডার করা
    public function showRegister()
    {
        return view('auth.register');
    }

    // Axios এর ডাটা রিসিভ ও ডাটাবেজে সেভ করা
    public function register(RegistrerRequest $request)
    {
        $validated = $request->validated();
        $userData = Arr::only($validated, ['name', 'email', 'outlate', 'password']);
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
                'message' => 'Something went wrong, please try again.',
                'data'    => $e->getMessage()
            ], 500);
        }
    }
}
