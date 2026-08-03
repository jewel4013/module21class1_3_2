@extends('layouts.app')
@section('title', 'Brands')
@section('PageHeader')
    Brands
@endsection

@push('style')
    <style>
        .table-responsive {
            overflow: visible !important;
        }
    </style>
@endpush

@push('mainSection')
 
    <div class="container text-center py-5">
        <h1 class="display-1 text-muted">404</h1>
        <h3>Sorry, this page does not exist!</h3>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Go to Profile</a>
    </div>
    

@endpush