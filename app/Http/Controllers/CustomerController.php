<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerEditRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('auth.customers.customers', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.customers.customersCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerCreateRequest $request)
    {
        $validated = $request->validated();
        try{
            $validated['user_id'] = Auth::id(); // Assuming you want to associate the customer with the currently authenticated user
            Customer::create($validated);
            return response()->json([
                'status' => true,
                'message' => 'Customer created successfully',
            ], 201);
        }catch(\Exception $e){
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, please try again',
            ], 500);
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {        
        return view('auth.customers.customersEdit' , compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerEditRequest $request, Customer $customer)
    {
        $validated = $request->validated();
        try{
            $validated['user_id'] = Auth::id();  // Assuming you want to associate the customer with the currently authenticated user
            $customer->update($validated);
            return response()->json([
                'status' => true,
                'message' => 'Customer updated successfully',
            ], 200);
        }catch(\Exception $e){
            Log::critical($e->getMessage().' '.$e->getFile().' '.$e->getLine());
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, please try again',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
