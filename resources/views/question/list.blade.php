@extends('layouts.app')

@section('content')
<div class="question-list">
  <div class="row">
      <div class="col-lg-8">
          <h1 class="page-header text-black">All Questions</h1>

          @foreach ($questions as $question)
          <div class="question-item">
            <div class="row">
              <div class="col-lg-2">
                <div class="votes">
                  <span class="count">0</span>
                  <p>votes</p>
                </div>

                <div class="status">
                  <span class="count">0</span>
                  <p>votes</p>
                </div>

                <div class="view">
                  <span class="count">0</span> views                  
                </div>

              </div>
              <div class="col-lg-10">
                <a href="#" class="title">{{ $question->title }}</a>
                <div class="excerpt">{!! mb_strimwidth($question->content, 0, 200, "...") !!}</div>
                <div class="tag-list">

                  @foreach (explode(',',$question->tag) as $tag)
                    <a href="/tag/{{ $tag }}" class="item">
                      {{ $tag }}
                    </a>
                  @endforeach
                  
                 
                </div>
                
                <div class="question-author-info pull-right">
                    <p>asked {{ $question->created_at->diffForHumans() }}</p>
                    <img width="60px" height="60px" src="{{ '/uploads/avatars/'. ($question->user)['avatar'] }}"/>
                    <a href="/user/{{ $question->created_by}}">&nbsp; {{ ($question->user)['name'] }}</a>
                </div>

              </div>
            </div>

          </div>

          @endforeach
      </div>

      <div class="col-lg-4">
        <div class="row ask-question">          
            <span class="questions-count">{{ $question_count }}</span>&nbsp;<span>questions</span>
            <a class="pull-right btn btn-primary">Ask Question</a>
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
