@extends('layout.backend')

@section('main_content')
    <div class="container">

            <div class="card">
                <div class="card-header bg-success">
                    <h1 class="text-center text-light">Product Details</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('Upload/Products/'.$product->photo) }}" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-6">
                            <h2>{{ $product->name }}</h2>
                            <h4>Price: {{ $product->price }}$</h4>
                            <p>Description: {{ $product->description }}</p>
                            <a href="{{ route('admin.product') }}" class="btn btn-dark">Back</a>
                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection
