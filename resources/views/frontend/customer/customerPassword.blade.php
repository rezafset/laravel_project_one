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
                        <h4>Password Change</h4>
                    </div>
                    @if (session()->has('password_message'))
                        <strong class="text-danger text-center mt-2">{{ session()->get('password_message') }}</strong>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('customer.password') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Old Password</label>
                                <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="old_password">
                                @error('old_password')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password">
                                @error('new_password')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password">
                                @error('confirm_password')
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
