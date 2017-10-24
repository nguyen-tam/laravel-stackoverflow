@extends('layouts.app')

@section('script')
    <link href="{{ asset('plugins/tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
@section('script')
    <script src="{{ asset('plugins/tagsinput/bootstrap-tagsinput.js') }}"></script>
@endsection
@section('content')
<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Question</h1>
    </div>
</div>
<!-- /.row -->

<!-- Content Row -->
<div class="row">
    <div class="col-lg-8">
        <form method="POST" action="{{ route('questions.edit') }}">
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{ $question->id }}">
            <div class="form-group">
                <input id="title" type="text" class="form-control" name="title" value="{{ $question->title }}" required autofocus>
            </div>

            <div class="form-group">
                <textarea name="content" class="form-control" rows="15" required>{{ $question->content }}</textarea>
            </div>        

            <div class="form-group">
                <input type="text" value="{{ $question->tags }}" name="tag" class="form-control" data-role="tagsinput">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>        
        </form>
    </div>
    
</div>
          
@endsection
