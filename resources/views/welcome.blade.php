@extends('layouts.app')

@push('mainSection')
 <!-- ড্যাশবোর্ড মেইন কার্ড গ্রিড জোন -->
            <div class="row g-4">
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card border-0 shadow-sm p-4 bg-white border-start border-success border-4 rounded-3">
                        <span class="text-muted small text-uppercase fw-bold d-block mb-1">Today's Sales</span>
                        <h2 class="fw-extrabold text-dark mb-0">৳0.00</h2>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card border-0 shadow-sm p-4 bg-white border-start border-primary border-4 rounded-3">
                        <span class="text-muted small text-uppercase fw-bold d-block mb-1">This Month Sales</span>
                        <h2 class="fw-extrabold text-dark mb-0">৳0.00</h2>
                    </div>
                </div>
                
                <div class="col-12 mt-4">
                    <div class="card border-0 shadow-sm p-4 bg-white rounded-4 min-vh-50">
                        <h5 class="fw-bold text-dark mb-3">Recent Activities</h5>
                        <p class="text-muted small">Your sales transactions and invoice logs will appear here live using Axios.</p>
                    </div>
                </div>
            </div>


  
    

    <!-- 🚀 আপনার নিজস্ব ও ওয়ার্কিং জেএস সিডিএন লিংকসমূহ (বুটস্ট্র্যাপ বান্ডেলটি অফ-ক্যানভাস টগলের জন্য আবশ্যিক) -->
   

    
@endpush