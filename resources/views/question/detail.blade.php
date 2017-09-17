@extends('layouts.app')

@section('css')
    <link href="{{ asset('plugins/tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
@section('script')
    <script src="{{ asset('plugins/tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script>      
      const app = new Vue({
          el: '#app'
      });

</script>
@endsection
@section('content')
<div class="question-detail">
  <div class="row">
      <div class="col-lg-8">
          <h1 class="page-header">{{ $question->title }}</h1>
      </div>

      <div class="col-lg-4 text-right">
          <a class="btn btn-primary">Ask Question</a>
      </div>
  </div>
  <!-- /.row -->

  <!-- Content Row -->
  <div class="row">
      <div class="col-lg-8 left-side" id="app">        
          <question-detail question_id = "{{ $question->id }}"></question-detail>
      </div>
      <div class="col-lg-4 right-side">   
          <div class="info">
            <p>asked: {{ $question->created_at->diffForHumans() }}</p>
            <p>viewed: {{ number_format($question->views,0) }} times</p>
          </div>     
          
      </div>
      
  </div>
<div>
          
@endsection
