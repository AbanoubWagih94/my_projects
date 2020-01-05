@extends('admin.layouts.master')

@section('page')
    Add Product
@endsection
@section('content')
    <div class="row">
        <div class="col-md-10">
            @include('admin.layouts.messages')
            <div class="card">
                <div class="header">
                    <h4 class="title">Add product</h4>
                </div>
                <div class="content">
                    <form action="{{url('admin/products')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('name')? 'has-error' : ''}}">
                                    <label for="product_name">Product Name:</label>
                                    <input type="text" class="form-control border-input" name="name" id="product_name" placeholder="Macbook pro">
                                    <span class="text-danger">{{ $errors->has('name')? $errors->first('name'): ''}}</span>
                                </div>
                                <div class="form-group {{ $errors->has('price')? 'has-error' : ''}}">
                                    <label for="product_price">Product Price:</label>
                                    <input type="text" class="form-control border-input" name="price" id="product_price" placeholder="$2500">
                                    <span class="text-danger">{{ $errors->has('price')? $errors->first('price'): ''}}</span>
                                </div>
                                <div class="form-group {{ $errors->has('description')? 'has-error' : ''}}">
                                    <label for="product_description">Product Description:</label>
                                    <textarea cols="30" rows="10" class="form-control border-input" name="description" placeholder="Product Description"></textarea>
                                    <span class="text-danger">{{ $errors->has('description')? $errors->first('description'): ''}}</span>
                                </div>
                                <div class="form-group">
                                    <label for="product_image {{ $errors->has('image')? 'has-error' : ''}}">Product Image:</label>
                                    <input type="file" class="form-control border-input" name="image" id="image">
                                    <div id="thumb-output"></div>
                                    <span class="text-danger">{{ $errors->has('image')? $errors->first('image'): ''}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-fill btn-wd">Add Product</button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection