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
                        <h5 class="card-text"> <a type="button" class="btn btn-dark" href="{{ route('user.password') }}">Change Password</a> </h5>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Profile</h4>
                    </div>
                    <div class="card-body">
                        @if (session()->has('profileUpdate'))
                            <div class="text-center">
                                <strong class="text-success">{{ session()->get('profileUpdate') }}</strong>
                            </div>
                        @endif
                        <form action="{{ route('profile') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name">
                                @error('name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email">
                                @error('email')
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
