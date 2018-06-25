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
                  <span class="count">{{ $question->votes }}</span>
                  <p>votes</p>
                </div>

                <div class="status">
                  <span class="count">{{ $question->answers }}</span>
                  <p>answers</p>
                </div>

                <div class="view">
                  <span class="count">{{ $question->views }}</span> views                  
                </div>

              </div>
              <div class="col-lg-10">
                <a href="/questions/{{ $question->id }}/{{ $question->slug }}" class="title">{{ $question->title }}</a>
                <div class="excerpt">{!! mb_strimwidth($question->content, 0, 200, "...") !!}</div>
                <div class="tag-list">

                  @foreach ($question->tag as $tag)
                    <a href="/tag/{{ $tag->name }}" class="item">
                      {{ $tag->name }}
                    </a>
                  @endforeach
                  
                 
                </div>
                
                <div class="question-author-info pull-right">
                    <p>asked {{ $question->created_at->diffForHumans() }}</p>
                    <img width="60px" height="60px" src="{{ '/uploads/avatars/'. ($question->user)['avatar'] }}"/>
                    <a href="/user/{{ $question->created_by}}/view">&nbsp; {{ ($question->user)['name'] }}</a>
                </div>

              </div>
            </div>

          </div>

          @endforeach
      </div>

      <div class="col-lg-4">
        <div class="row ask-question">          
            <span class="questions-count">{{ $question_count }}</span>&nbsp;<span>questions</span>
            <a href="/questions/ask" class="pull-right btn btn-primary">Ask Question</a>
        </div>  
        
        <div class="row">          
            <h3>Top Tags</h3>
            
            <div class="tag-list">

              @foreach ($top_tags as $item)
              <p>
                <a href="/tag/{{ $item->name }}" class="item">
                  {{ $item->name }}
                </a>

                x {{$item->total }}
              </p>
              @endforeach
             
            </div>

        </div>

        <div class="row newest-question">          
            <h3>Newest questions</h3>
            
            @foreach ($newest_questions as $question)
            <div class="item">
              <a href="/questions/{{ $question->id }}/{{ $question->slug }}" class="title">{{ $question->title }}</a>
            </div>
            @endforeach
            
        </div>
          
      </div>
  </div>

<div>
          
@endsection
