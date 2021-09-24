@extends('layout.frontend')

@section('frontend_main')
<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow">
                @include('frontend.customer.profileCart')
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Customer Profile</h4>
                </div>
                <div class="card-body">
                    <h5 class="mb-3">Name: {{ Auth::user()->name }}</h5>
                    <h5 class="card-text mb-3">Email: {{ Auth::user()->email }} </h5>
                    <h5 class="card-text mb-3">Mobile No: {{ Auth::user()->phone }} </h5>
                    <h5 class="card-text mb-3">Address: {{ Auth::user()->address }} </h5>
                    <h5 class="card-text mb-3">Created at: {{ Auth::user()->created_at->format('D, d M Y H:i') }} </h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
