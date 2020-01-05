@extends('site.layouts.app')
@section('title', 'Vendors')

@section('extra_links')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
    <div class="container-fluid">
        <form class="form-group" role="search" style="width:100%;">
            <div class="input-group" style="width:90%; margin:auto auto; display:block;">
                    <input type="text" data-toggle="modal" data-target="#myModal" class="form-control" placeholder="Filter" name="filter-term" id="filter-term">
                    <button class="btn btn-default" id="filter-action">
                        <i class="glyphicon glyphicon-filter"></i>
                    </button>
            </div>
        </form>
    </div>

    <div class="container">
        <h3>Vendors</h3>
        <div class="container-fluid">
        @foreach($vendors as $vendor)
        <div class="col-md-3 col-sm-4" style="padding:15px;">
            <div class="vendor">
            <a href="{{route('vendor', ['id'=>$vendor->id])}}">
            <img src="{{asset($vendor->logo)}}" class="img-circle" style="padding:5px; width:70%; border:2px solid #c0272c">
            </a>
                <hr>
                <h4>{{$vendor->name}}</h4>
                <h5>{{$vendor->category->name}}</h5>
            </div>
        </div>
        @endforeach
        </div>
        <hr>
    </div>
    <?php echo $vendors->render(); ?>
@endsection

