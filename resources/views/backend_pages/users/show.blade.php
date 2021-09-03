@extends('layout.backend')

@section('main_content')
    <div class="container">

            <div class="card">
                <div class="card-header bg-success">
                    <h1 class="text-center text-light">User Details</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <img src="{{ asset('Upload/Users/'.$user->user_photo) }}" class="img-fluid" height="300" width="300" alt="">
                        </div>
                        <div class="col-md-6">
                            <h2>{{ $user->name }}</h2>
                            <h4>Email: {{ $user->email }}</h4>
                            <p>Address: {{ $user->address }}</p>
                            <p>Mobile: {{ $user->phone }}</p>
                            <p>Role: As {{ $user->role }}</p>
                            <a href="{{ route('admin.user') }}" class="btn btn-dark">Back</a>
                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection
