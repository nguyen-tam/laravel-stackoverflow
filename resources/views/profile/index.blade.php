@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Profile page</h1>
    </div>
</div>
<!-- /.row -->

<!-- Content Row -->

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Edit Profile</a></li>
  <li><a data-toggle="tab" href="#activity">Activity</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <h3>Edit your profile</h3>
    <!-- <p>Public information</p> -->
    <div class="row">
        <div class="col-lg-4">

            <form enctype="multipart/form-data" action="/user/upload_avatar" method="POST">
                {{ csrf_field() }}
            
                <div>
                    <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;"/>
                </div>
                <br/>
                <input type="file" name="avatar">
                <br/>
                <input type="submit" value="Save avatar" class="btn btn-sm btn-primary">
            </form>
        </div>
        <div class="col-lg-8">
             <form method="POST" action="/user/update_profile">
            {{ csrf_field() }}

                <div class="form-group">
                    <label for="display_name">Display Name</label>
                    <input id="display_name" type="text" class="form-control" name="display_name" value="{{ $user->name }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input id="location" placeholder="Enter a location" type="text" class="form-control" name="location" value="{{ $user->location }}">
                </div>        

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="title" placeholder="No title has been set" type="text" class="form-control" name="title" value="{{ $user->title }}" >
                </div>

                <div class="form-group">
                    <input type="submit" value="Save changes" class="btn btn-sm btn-primary">                    
                </div>   
            </form>     
        </div>

    </div>


  </div>
  <div id="activity" class="tab-pane fade">
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
            @foreach ($answers as $answers)
                <div>
                    <a href="/question/{{ $answers->id }}/{{ $answers->slug }}">{{ $answers->title }}</a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row"></div>
  </div>
</div>
          
@endsection
