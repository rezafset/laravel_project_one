@extends('layout.backend')

@section('main_content')
    <div class="container">
        <h3 class="text-center">Order List</h3>
        <div class="table-responsive mt-3">
            <table id="example" class="table table-bordered text-center" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Truck No</th>
                        <th scope="col">Email</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orders as $key=> $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $order->truck_no }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                            <td>
                                <span class="badge bg-primary">{{ $order->status }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-success btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
