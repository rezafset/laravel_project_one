@extends('layout.backend')

@section('main_content')
<div class="container">
    <div class="row">
        <div class="col-md-8 m-auto">
            <form action="{{ route('admin.user.edit', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header bg-success">
                        <h2 class="text-center text-light">Update User</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-1">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" id="name">
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{ $user->email }}" id="price">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label for="phone" class="form-label">Mobile</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"  value="{{ $user->phone }}" id="price">
                            @error('phone')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-1">
                            <label for="address" class="form-label">Address</label>
                            <textarea type="text" class="form-control @error('address') is-invalid @enderror"
                                name="address" id="address"> {{ $user->address }} </textarea>
                            @error('address')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label for="user_photo" class="form-label">User Image</label>
                            <input type="file" class="form-control @error('user_photo') is-invalid @enderror" name="user_photo" id="user_photo">
                            <img src="{{ asset('Upload/Users/'.$user->user_photo) }}" class="image-fluid mt-3" height="60" width="60" alt="">
                            @error('user_photo')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Update User</button>
                            <a href="{{ route('admin.user') }}"><button type="button" class="btn btn-dark">Back</button></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
