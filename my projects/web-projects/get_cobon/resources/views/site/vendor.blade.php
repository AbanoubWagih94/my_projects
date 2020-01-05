@extends('site.layouts.app')
@section('title', 'vendor')

@section('extra_links')
    <link rel="stylesheet" href="{{asset('css/vendor.css')}}">
@endsection

@section('content')
<div class="container" id="channel_details">
    <div class="row">
        <div class="col-sm-3" style="padding:15px; text-align:center;">
            <img src="{{asset('images/logos_red.png')}}" style="padding:0px; width:70%; border:2px solid #c0272c;" class="img-circle" >
        </div>
        <div class="col-sm-9" style="padding:20px;">
                <h2>{{$vendor->name}}</h2>
        </div>
    </div>

    <hr>
    <div class="container-fluid">
        <h2 style="color:#c0272c; font-weight:bold;">Additional info.</h2>
        <p>{{$vendor->description}}</p>
    </div>
    <hr>
    <div class="container-fluid">
        <h2 style="color:#c0272c; font-weight:bold;">Branches</h2> 
        <ul>
        @foreach($vendor->branches as $branch)
            <li>
                <h3>{{$branch->name}}</h3>
                <div>
                    <table>
                        <tr>
                            <td>Branch Address</td>
                            <td>{{$branch->location}}</td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>{{$branch->city->name}}</td>
                        </tr>
                        <tr>
                            <td>phone number</td>
                            <td>{{$branch->phone_number}}</td>
                        </tr>
                    </table><br>
                </div>
            </li>
        @endforeach
        </ul>                   
    </div>
</div>
@endsection