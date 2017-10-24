@extends('layouts.app')

@section('css')
    <link href="{{ asset('plugins/tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">
@section('script')
    <script src="{{ asset('plugins/tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script>      
      const app = new Vue({
          el: '#app'
      });

</script>
@endsection
@section('content')
<div class="question-detail">
  <div class="row question-title">
      <div class="col-lg-8">
          <h1 class="page-header text-black">{{ $question->title }}</h1>
      </div>

      <div class="col-lg-4 text-right">
          <a href="/questions/ask" class="page-header btn btn-primary">Ask Question</a>
      </div>
  </div>

  <!-- /.row -->
  <br/>
  <!-- Content Row -->
  <div class="row">
      <div class="col-lg-8 left-side" id="app">        
          <question-detail question_id = "{{ $question->id }}"></question-detail>

          @if (Auth::check())
          <div class="row post-answer">
            <form method="POST" action="{{ route('questions.answer') }}">
              {{ csrf_field() }}
              <input type="hidden" name="question_id" value="{{ $question->id }}">
              <textarea class="ckeditor" name="answer"></textarea>
              <br/>
              <input type="submit" class="btn btn-primary" value="Post Your Answer" />
            </form>
          </div>
          @endif

      </div>
      <div class="col-lg-4 right-side">   
          <div class="info">
            <p><span class="text-grey">asked:</span> {{ $question->created_at->diffForHumans() }}</p>
            <p><span class="text-grey">viewed:</span> {{ number_format($question->views,0) }} times</p>
          </div>     

          <div class="row newest-question">          
            <h3>Newest questions</h3>
            
            @foreach ($newest_questions as $question)
            <div class="item">
              <a href="#" class="title">{{ $question->title }}</a>
            </div>
            @endforeach
            
        </div>
          
      </div>     
  </div>

<div>
          
@endsection
