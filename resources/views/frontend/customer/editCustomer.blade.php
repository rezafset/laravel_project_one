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
                    <h4>Edit Profile</h4>
                </div>
                @if (session()->has('update_cutomer'))
                    <strong class="text-success text-center mt-2">{{ session()->get('update_cutomer') }}</strong>
                @endif
                <div class="card-body">
                    <form action="{{ route('customer.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-1">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}"
                            class="form-control @error('name') is-invalid @enderror" id="name">
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label for="phone" class="form-label">Mobile</label>
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"  value="{{ auth()->user()->phone }}" id="price">
                            @error('phone')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label for="address" class="form-label">Address</label>
                            <textarea type="text" class="form-control @error('address') is-invalid @enderror"
                                name="address" id="address"> {{ auth()->user()->address }}</textarea>
                            @error('address')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="user_photo" class="form-label">User Image</label>
                            <input type="file" class="form-control @error('user_photo') is-invalid @enderror" name="user_photo" id="user_photo">
                            <img src="{{ asset('Upload/Users/'.auth()->user()->user_photo) }}" class="image-fluid mt-3" height="60" width="60" alt="">
                            @error('user_photo')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Upadte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
