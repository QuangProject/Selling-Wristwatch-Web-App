@extends('layouts.admin')

@section('title')
    Order
@endsection

@section('content')
    <main id="main" class="main">
        <div class="mt-4 mb-3">
            <div class="text-center lh-1 mb-2">
                <h2 class="fw-bold">Order List</h2>
            </div>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Full Name</th>
                    <th>Telephone</th>
                    <th>Address</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Shipping Fee</th>
                    <th>Total Price</th>
                    <th>Detail</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                        <td>{{ $order->telephone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->delivery_date }}</td>
                        <td>${{ $order->shipping_fee }}</td>
                        <td><b>${{ $order->total_price }}</b></td>
                        <td>
                            <a href="{{ route('admin.order.detail', $order->id) }}" class="ms-3"><i
                                    class="fa-solid fa-angle-right"></i></a>
                        </td>
                        <td>
                            <select class="form-select orderStatus" aria-label="Default select example" data-id="{{ $order->id }}">
                                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Processed</option>
                                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Order sent</option>
                                <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Order en route</option>
                                <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Arrived</option>
                                <option value="5" {{ $order->status == 5 ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Order ID</th>
                    <th>Full Name</th>
                    <th>Telephone</th>
                    <th>Address</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Shipping Fee</th>
                    <th>Total Price</th>
                    <th>Detail</th>
                    <th>Status</th>
                </tr>
            </tfoot>
        </table>
    </main>
@endsection

@section('js')
    <script src="{{ asset('js/order.js') }}"></script>
@endsection
