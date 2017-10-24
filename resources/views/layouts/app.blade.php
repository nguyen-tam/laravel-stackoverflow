<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Stuff -->
  <meta name="csrf-token" content="{!! csrf_token() !!}">
  <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
  <title>{{ config('app.name', 'PHP StackOverflow') }}</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom-style.css') }}" rel="stylesheet">
  @yield('css')  

</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}">LaraOverflow</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="{{ url('questions/list') }}">Questions</a>
          </li>
          @if (!Auth::guest())
          <li>
            <a href="{{ url('users/'. Auth::user()->id ) }}">Hello, {{ Auth::user()->name }}</a>
          </li>
          <li>
            <a href="{{ url('logout') }}">Log out</a>
          </li>
          @endif

          @if (Auth::guest())
            <li>
              <a href="{{ url('login') }}">Login</a>
            </li>
            <li>
              <a href="{{ url('register') }}">Register</a>
            </li>
          @endif
          
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>  

  <div class="container">

    @yield('content')    

    <hr>

    <!-- Footer -->
    <footer>
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright &copy; Your Website 2017</p>
        </div>
      </div>
    </footer>

  </div>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('script')
</body>
</html>

