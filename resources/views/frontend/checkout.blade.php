@extends('layout.frontend')

@section('frontend_main')
    <div class="container py-2 my-2">
        <div class="row">
            <div class="col-md-6">
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
                            <td class="font-weight-bold">Total</td>
                            <td class="font-weight-bold"> {{ $total_quantity }}</td>
                            <td class="font-weight-bold"> {{ $total_price }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- <a href="{{ route('customer.checkout') }}" class="btn btn-success">Checkout</a> --}}
            <div class="col-md-6">
                <form action="{{ route('customer.order') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-center text-light">User Information</h4>
                        </div>
                        @if (session()->has('register_success'))
                            <strong class="text-success text-center mt-2">{{ session()->get('register_success') }}</strong>
                        @endif
                        <div class="card-body">
                            <div class="mb-1">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name }}" id="name">
                                @error('name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{ auth()->user()->email }}" id="price">
                                @error('email')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="phone" class="form-label">Mobile</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"  value="{{ auth()->user()->phone }}" id="price">
                                @error('phone')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="address" class="form-label">Address</label>
                                <textarea type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" id="address"> {{ auth()->user()->address }} </textarea>
                                @error('address')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label for="payment_method" class="form-label" >Payment Method</label>
                                <select class="form-control" id="payment_method" name="payment_method">
                                    <option selected>bKash</option>
                                    <option value="1">Nogod</option>
                                    <option value="2">Rocket</option>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="transaction_id" class="form-label" >Transaction ID</label>
                                <input type="text" name="transaction_id" class="form-control" id="transaction_id">
                            </div>
                            <input type="hidden" name="price" value="{{ $total_price  }}">
                            <input type="hidden" name="quantity" value="{{ $total_quantity  }}">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Place Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
