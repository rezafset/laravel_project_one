@extends('layout.backend')

@section('main_content')
<div class="container">
    <div class="row">
        <div class="col-md-8 m-auto">
            <form action="{{ route('admin.product.edit', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header bg-success">
                        <h2 class="text-center text-light">Update Product</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" id="name">
                            @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Product Price</label>
                            <input type="text" value="{{ $product->price }}" class="form-control @error('price') is-invalid @enderror" name="price" id="price">
                            @error('price')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Product Description</label>
                            <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ $product->description }}</textarea>
                            @error('description')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Product Image</label>
                            <input type="file" class="form-control" name="photo" id="photo">
                            <img src="{{ asset('Upload/Products/'.$product->photo) }}" class="img-fluid mt-3" height="100" width="100" alt="">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Update Product</button>
                            <a href="{{ route('admin.product') }}"><button type="button" class="btn btn-dark">Back</button></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
