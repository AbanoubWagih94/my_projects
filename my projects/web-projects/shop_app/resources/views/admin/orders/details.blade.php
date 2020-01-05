@extends('admin.layouts.master')

@section('page')
    Order Details
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Order Details</h4>
                    <p class="category">Order Details</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->date }}</td>
                            <td>{{ $order->address }}</td>
                            <td>
                                @if($order->status)
                                    <span class="label label-success">Confirmed</span>
                                @else
                                    <span class="label label-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if($order->status)
                                    {{ link_to_route('order.changeStatus','',[$order->id, $order->status], ['class'=>'btn btn-sm btn-success ti-close', 'title'=>'Cancel Order']) }}
                                @else

                                    {{ link_to_route('order.changeStatus','',[$order->id, $order->status], ['class'=>'btn btn-sm btn-success ti-check', 'title'=>'Confirm Order']) }}
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">User Details</h4>
                    <p class="category">User Details</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-stripped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <td>{{ $order->user->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $order->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $order->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Registered At</th>
                            <td>{{ $order->user->created_at->diffForHumans() }}</td>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Product Details</h4>
                    <p class="category">Product Details</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-stripped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                        </tr>
                        </thead>
                        <tbody>
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
                                            <td>{{ $item->price }}</td>
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
                                @foreach($order->products as $product)
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <a href="{{ url('uploads/', $product->image_url) }}" target="_blank">
                                                    <img src="{{ url('uploads/', $product->image_url) }}" alt="{{ $product->img_url }}" class="img-thumbnail" style="width: 5em;">
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                @endforeach
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection