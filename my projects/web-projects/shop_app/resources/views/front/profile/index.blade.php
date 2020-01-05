@extends('front.layouts.master')

@section('content')
    <h2>Profile</h2> <hr>

    <h3>User Details</h3>
    @if(session()->has('msg'))
        <div class="alert- alert-success">{{ session()->get('msg') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="2">User Details <a href="{{ url('/user/edit').'/'.$user->id }}" class="pull-right"><i class="fa fa-cogs"></i>Edit user</a></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $user->id }}</td>
            </tr>

            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>

            <tr>
                <th>Registered At</th>
                <td>{{ $user->created_at->diffForHumans() }}</td>
            </tr>
        </tbody>
    </table>
    <h4 class="title">Orders</h4><hr>
    <div class="content table-responsive table-full-width">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user->orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>
                        @foreach($order->products as $item)
                            <table class="table">
                                <tr>
                                    <td>{{ $item->name }}</td>
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
                                    <td>{{ $item->price }}</td>
                                </tr>
                            </table>
                        @endforeach
                    </td>
                    <td>
                        @if($order->status)
                            <span class="badge badge-success">Confirmed</span>
                        @else
                            <span class="badge badge-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        {{ link_to_route('user.orders', 'Details', $order->id, ['class'=>'btn btn-sm btn-outline-dark', 'title'=>'Details']) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection