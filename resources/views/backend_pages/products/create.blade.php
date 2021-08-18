@extends('layout.backend')

@section('main_content')
<div class="container">
    <div class="row">
        <div class="col-md-10 m-auto">
            <form action="{{ route('admin.product.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header bg-primary">
                        <h2 class="text-center text-light"> Create Product</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name">
                            @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Product Price</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
                                id="price">
                            @error('price')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Product Description</label>
                            <textarea type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" id="description"></textarea>
                            @error('description')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Product Image</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo"
                                id="photo">
                            @error('photo')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                            <a href="{{ route('admin.product') }}"><button type="button"
                                    class="btn btn-dark">Back</button></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
