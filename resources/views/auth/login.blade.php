@extends('layout.frontend')

@section('frontend_main')
    <div class="container py-5 my-5">
    <div class="row">
        <div class="col-md-6 m-auto mt-5">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-light">Login Form</h3>
                </div>
                @if (session()->has('success_password'))
                    <strong class="text-success text-center mt-2">{{ session()->get('success_password') }}</strong>
                @endif
                @if (session()->has('error'))
                    <strong class="text-danger text-center mt-2">{{ session()->get('error') }}</strong>
                @endif
                @if (session()->has('not_allow'))
                    <strong class="text-danger text-center mt-2">{{ session()->get('not_allow') }}</strong>
                @endif
                @if (session()->has('password_message'))
                    <strong class="text-success text-center mt-2">{{ session()->get('password_message') }}</strong>
                @endif
                <div class="card-body">
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="email">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password">
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center ">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <span class="">Are you register??
                                <a href="{{ route('customer.register') }}">Register</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
