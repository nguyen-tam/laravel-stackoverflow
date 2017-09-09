<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PHP StackOverflow</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="css/app.css" rel="stylesheet">
        <link href="css/custom-style.css" rel="stylesheet">

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
                  <a class="navbar-brand" href="{{ url('/') }}">PHP - QA</a>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                      <li>
                          <a href="{{ url('questions') }}">Questions</a>
                      </li>
                      <li>
                          <a href="{{ url('users') }}">Users</a>
                      </li>
                      <li>
                          <a href="{{ url('login') }}">Login</a>
                      </li>
                      <li>
                          <a href="{{ url('register') }}">Register</a>
                      </li>
                  </ul>
              </div>
              <!-- /.navbar-collapse -->
          </div>
          <!-- /.container -->
      </nav>

      <div class="container">

          <!-- Page Heading/Breadcrumbs -->
          <div class="row">
              <div class="col-lg-12">
                  <h1 class="page-header">Newest sss Questions</h1>
                  {{-- <ol class="breadcrumb">
                      <li><a href="index.html">Home</a>
                      </li>
                      <li class="active">Full Width Page</li>
                  </ol> --}}
              </div>
          </div>
          <!-- /.row -->

          <!-- Content Row -->
          <div class="row">
              <div class="col-lg-12">
                  <p>Most of Start Bootstrap's unstyled templates can be directly integrated into the Modern Business template. You can view all of our unstyled templates on our website at <a href="http://startbootstrap.com/template-categories/unstyled">http://startbootstrap.com/template-categories/unstyled</a>.</p>
              </div>
          </div>
          <!-- /.row -->

          <hr>

          <!-- Footer -->
          <footer>
              <div class="row">
                  <div class="col-lg-12">
                      <p>Copyright &copy; Your Website 2014</p>
                  </div>
              </div>
          </footer>

      </div>

    </body>
</html>
