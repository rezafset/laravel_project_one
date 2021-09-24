@extends('layout.frontend')

@section('frontend_main')
    <div class="container">
        <div class="">
            <h4 class=" py-3 text-center">Selected Product List</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $key => $cart)
                        <tr>
                            <td>{{ $cart['name'] }}</td>
                            <td>{{ $cart['price'] }}</td>
                            <td>{{ $cart['description'] }}</td>
                            <td>{{ $cart['quantity'] }}</td>
                            <td>{{ $cart['quantity'] * $cart['price']  }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
