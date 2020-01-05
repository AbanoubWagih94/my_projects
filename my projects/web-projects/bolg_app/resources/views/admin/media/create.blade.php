@extends('layouts.admin')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet">
@endsection

@section('content')
    <h1>Upload Media</h1>

    <form method="post" action="{{ route('media.store') }}" class="dropzone" enctype="multipart/form-data">
        {{ csrf_field()}}
        <div class="fallback">
            <input name="file" class="form-contorl" type="file" multiple />
        </div>
    </form>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@endsection
