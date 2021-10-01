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
                    @php
                        $total_quantity = 0;
                        $total_price = 0;
                    @endphp
                    @foreach ($carts as $key => $cart)
                        <tr>
                            <td>{{ $cart['name'] }}</td>
                            <td>{{ $cart['price'] }}</td>
                            <td>{{ $cart['description'] }}</td>
                            <td>{{ $cart['quantity'] }}</td>
                            <td>{{ $cart['quantity'] * $cart['price']  }}</td>
                        </tr>
                        @php
                            $total_quantity += $cart['quantity'];
                            $total_price = $total_price + $cart['quantity'] * $cart['price']
                        @endphp
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td> = {{ $total_quantity }}</td>
                        <td> = {{ $total_price }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="{{ route('customer.checkout') }}" class="btn btn-success">Checkout</a>
    </div>
@endsection
