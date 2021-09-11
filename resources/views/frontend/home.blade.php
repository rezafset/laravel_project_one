@extends('layout.frontend')

@section('frontend_main')
    <section class="jumbotron text-center">
        <div class="container">
            <h1>Album example</h1>
            <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc.
                Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
            <p>
                <a href="#" class="btn btn-primary my-2">Main call to action</a>
                <a href="#" class="btn btn-secondary my-2">Secondary action</a>
            </p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img src="{{ asset('Upload/Products/'.$product->photo) }}" height="220" width="100%" alt="">
                            <div class="card-body">
                                <p class="card-text">Name: {{ $product->name }}</p>
                                <p class="card-text">Price: {{ $product->price }}$</p>
                                <p class="card-text">Description: {{ $product->description }}</p>
                                <p class="card-text">Uploaded: {{ $product->created_at->format('D, d M Y, g:i A') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
