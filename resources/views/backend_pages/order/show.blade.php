@extends('layout.backend')

@section('main_content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-center">Order Details</h3>
                <h6> <strong>Order No:</strong> {{ $order->truck_no }}</h6>
                <h6>Customer Name: {{ $order->name }}</h6>
                <h6>Customer Email: {{ $order->email }}</h6>
                <h6>Customer Phone: {{ $order->phone }}</h6>
                <h6>Customer Address: {{ $order->address }}</h6>
                <h6>Total Price: {{ $order->price }}</h6>
                <h6>Total Quantity: {{ $order->quantity }}</h6>
                <h6>Payment Method: {{ $order->payment_method }}</h6>
                <h6>Transaction ID: {{ $order->transaction_id }}</h6>
                <h6>Status: {{ $order->status }}</h6>
                <h6>Date: {{ $order->created_at->format('d-m-Y') }}</h6>
            </div>
            <div class="col-md-6">
                <h3 class="text-center">Product Details</h3>
                <div class="table-responsive mt-3">
                    <table id="example" class="table table-bordered text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($order->details as $key=> $details)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $details->product_name }}</td>
                                    <td>{{ $details->product_price }}</td>
                                    <td>{{ $details->quantity }}</td>
                                    <td>{{ $details->quantity * $details->product_price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form action="{{ route('admin.order.show', $order->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">

                            <label for="status" class="form-label">Status</label>
                            <select class="form-control form-select" name="status" id="status">
                                <option value="Pending" {{$order->status == 'Pending'?'selected' : ''}}>Pending</option>
                                <option value="Confirmed" {{$order->status == 'Confirmed'?'selected' : ''}}>Confirmed</option>
                                <option value="Processing" {{$order->status == 'Processing'?'selected' : ''}}>Processing</option>
                                <option value="Completed" {{$order->status == 'Completed'?'selected' : ''}}>Completed</option>
                                <option value="Rejected" {{$order->status == 'Rejected'?'selected' : ''}}>Rejected</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
