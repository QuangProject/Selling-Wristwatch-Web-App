@extends('layouts.admin')

@section('title')
    Order Detail
@endsection

@section('content')
    <main id="main" class="main">
        <div class="mt-4 mb-3">
            <div class="text-center lh-1 mb-2">
                <h2 class="fw-bold">Order Detail List</h2>
            </div>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Model</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetals as $orderDetal)
                    <tr>
                        <td>{{ $orderDetal->model }}</td>
                        <td>
                            <img src="{{ route('watch.image.get', ['id' => $orderDetal->image_id]) }}" width="100"
                                class="my-3" loading="lazy">
                        </td>
                        <td>${{ $orderDetal->selling_price }}</td>
                        <td>{{ $orderDetal->quantity }}</td>
                        <td><b>${{ $orderDetal->price }}</b></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Model</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </tfoot>
        </table>
        <div class="text-center">
            {{-- Back to orders --}}
            <a href="{{ route('admin.order.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
        </div>
    </main>
@endsection
