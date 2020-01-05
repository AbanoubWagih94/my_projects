@extends('admin.layouts.master')

@section('page')
    User Details
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{$orders[0]->user->name}} Orders Details</h4>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-stripped">
                        <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        @foreach($order->products as $product)
                                            <table class="table">
                                                <tr>
                                                    <td>{{ $product->name }}</td>
                                                </tr>
                                            </table>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($order->OrderItems as $item)
                                            <table class="table">
                                                <tr>
                                                    <td>{{ $item->quantity }}</td>
                                                </tr>
                                            </table>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($order->OrderItems as $item)
                                            <table class="table">
                                                <tr>
                                                    <td>{{ $item->quantity }}</td>
                                                </tr>
                                            </table>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($order->status)
                                            <span class="label label-success">Confirmed</span>
                                        @else
                                            <span class="label label-warning">Pending</span>
                                            @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection