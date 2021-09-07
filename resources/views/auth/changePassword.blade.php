@extends('layout.backend')
@section('main_content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="">
                    <img src="{{ asset('Upload/Users/'.Auth::user()->user_photo) }}" class="card-img-top" height="200"  alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title"> {{ Auth::user()->name }} </h5>
                    <h5 class="card-text"> {{ Auth::user()->role }} </h5>
                    <h5 class="card-text"> {{ Auth::user()->email }} </h5>
                    <h5 class="card-text"> {{ Auth::user()->phone }} </h5>
                    <h5 class="card-text"> {{ Auth::user()->address }} </h5>
                    <h5 class="card-text"> {{ Auth::user()->created_at->format('D, d M Y H:i') }} </h5>
                    <h5 class="card-text"> <a type="button" class="btn btn-dark" href="{{ route('profile') }}">Change User Info</a> </h5>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>Change Passsword</h4>
                </div>
                <div class="card-body">
                    @if (session()->has('wrong_pass'))
                        <div class="text-center">
                            <strong class="text-danger">{{ session()->get('wrong_pass') }}</strong>
                        </div>
                    @endif
                    @if (session()->has('no_match'))
                        <div class="text-center">
                            <strong class="text-danger">{{ session()->get('no_match') }}</strong>
                        </div>
                    @endif
                    <form action="{{ route('user.password') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="text" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="old_password">
                            @error('old_password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="text" name="new_password"
                                class="form-control @error('new_password') is-invalid @enderror" id="new_password">
                            @error('new_password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="text" name="confirm_password"
                                class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password">
                            @error('confirm_password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
