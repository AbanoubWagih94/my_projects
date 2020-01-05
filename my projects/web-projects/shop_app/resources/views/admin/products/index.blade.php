@extends('admin.layouts.master')

@section('page')
    View Products
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.layouts.messages')

            <div class="card">
                <div class="header">
                    <h4 class="title">All Products</h4>
                <p class="category">List of all products</p>
            </div>

            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Desc</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->description }}</td>
                                <td><a href="{{ url('uploads/' . $product->image_url ) }}" target="_blank"><img src="{{ url('uploads/' . $product->image_url ) }}" alt="{{ $product->image_url}}" class="img-thumbnail"
                                     style="width: 100px;"></a></td>
                                <td style="width: 150px">
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return(confirm('Are you sure you want delete this?') );"><span class="ti-trash"></span></button>
                                        {{ link_to_route('products.edit', '', $product->id, ['class'=>'ti-pencil-alt btn btn-info btn-sm', 'title'=>'Edit']) }}
                                        {{ link_to_route('products.show', '', $product->id, ['class'=>'ti-view-list-alt btn btn-primary btn-sm', 'title'=>'Details']) }}
                                    </form>
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