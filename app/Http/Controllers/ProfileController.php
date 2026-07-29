<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.profile');
    }

    public function profile(){
        $data = Auth::user();
        return new UserResource($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function profileUpdate(ProfileUpdateRequest $request)
    {
        try{
            /** @var User $user */
            
            $user = Auth::user();
            $validate = $request->validated();

            $userData = Arr::only($validate, ['name']);
            $profileData = Arr::only($validate, ['phone', 'address', 'avatar']);

            if ($request->hasFile('avatar')) {
                if ($user->profile && $user->profile->avatar && Storage::disk('public')->exists($user->profile->avatar)) {
                    Storage::disk('public')->delete($user->profile->avatar);
                }

                // নতুন ছবি সেভ করা এবং পাথের ডাটা পুশ
                $path = $request->file('avatar')->store('avatars', 'public');
                $profileData['avatar'] = $path;
            }

            $user->update($userData);
            $user->profile->update($profileData);
            
            
            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully',
                'data' => new UserResource($user),
            ], 200);
        }catch(\Exception $e){
            Log::critical($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
            ], 422);
        }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }


    public function settingsShow()
    {
        return view('auth.settings');
    }
}
