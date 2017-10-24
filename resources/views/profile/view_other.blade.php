@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Profile page</h1>
    </div>
</div>
<!-- /.row -->

<!-- Content Row -->

<div id="activity">
    <div class="row">
        <div class="col-lg-6">
            <h3>Posted these questions</h3>
            @foreach ($questions as $question)
                <div>
                    <a href="/question/{{ $question->id }}/{{ $question->slug }}">{{ $question->title }}</a>
                </div>
            @endforeach
        </div>
        <div class="col-lg-6">
            <h3>Answered on these questions</h3>
            @foreach ($answers as $answer)
                
                <div>
                    <a href="/question/{{ $answer->id }}/{{ $answer->slug }}">
                        {{ $answer->title }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row"></div>
</div>
          
@endsection
