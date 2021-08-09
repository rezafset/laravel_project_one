@extends('layout.backend')

@section('main_content')
<div class="container">
    <div class="row">
        <h2 class="text-center">Create Product</h2>
        <div class="col-md-8 m-auto">
            <form action="{{ route('admin.product.edit', $product->id) }}" method="POST">
                @csrf
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

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="{{ route('admin.product') }}"><button type="button" class="btn btn-dark">Back</button></a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
