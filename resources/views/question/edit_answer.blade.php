@extends('layouts.app')
@section('content')
<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Answer</h1>
    </div>
</div>
<!-- /.row -->

<!-- Content Row -->
<div class="row">
    <div class="col-lg-8">
        <form method="POST" action="{{ route('answer.edit') }}">
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{ $answer->id }}">
            <div class="form-group">
                <textarea name="content" class="form-control" rows="15" required>{{ $answer->content }}</textarea>
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
