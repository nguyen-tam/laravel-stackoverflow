@extends('layouts.app')

@section('content')

<!-- Page Heading/Breadcrumbs -->
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Register</h1>
  </div>
</div>
<!-- /.row -->

{{ Html::ul($errors->all()) }}

<!-- Content Row -->
<div class="row">
  <div class="login-box">
    <div class="login-box-body">

      <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

          <input id="name" type="text" placeholder="Name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

          @if ($errors->has('name'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <input id="email" type="email" placeholder="Email Address" class="form-control" name="email" value="{{ old('email') }}" required>

          @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

          <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>

          @if ($errors->has('password'))
          <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
              Register
            </button>
        </div>
      </form>
      
    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->
</div>

@endsection
