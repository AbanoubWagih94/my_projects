@extends('layouts.admin')


@section('content')
    <h1>Media</h1>
    <form action="{{ route('mediaDelete') }}" method="post" class="form-inline">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <div class="form-group mr-3">
            <select class="form-control" name="checkBoxArray" id="">
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Submit</button>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th> <input class="form-control" type="checkbox" id="options"></th>
                <th>Id</th>
                <th>Photo</th>
                <th>Created_At</th>
            </tr>
            </thead>
            <tbody>
            @if($photos)
                @foreach($photos as $photo)
                    <tr>
                        <td><input class="form-control checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
                        <td> {{$photo->id}} </td>
                        <td> <img src="{{ $photo->file? $photo->file:'http://placehold.it/300*300' }}"  alt="" height="80px"> </td>
                        <td>{{$photo->created_at->diffForHumans()}}</td>
                        <td>
                            <div class="form-group">
                                <input type="hidden" name="photo_id" value="{{ $photo->id }}">
                                <input type="submit" name="delete_single" value="Delete" class="btn btn-danger">
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </form>
    <script src="{{ url('bootstrap/js/jquery-3.3.1.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#options").click(function(){
                if(this.checked){
                    $(".checkBoxes").each(function () {
                        this.checked = true;
                    });
                } else{
                    $(".checkBoxes").each(function () {
                       this.checked = false;
                    });
                }
            });
        });
    </script>
@endsection