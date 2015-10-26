<!DOCTYPE html>
<html lang="pt" ng-app="cmsApp">
<head>
    
    @include('includes.head')
    
    @yield('head')
</head>
<body class="sidebar-wide">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">CMS ChessMarcos</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Perfil</a></li>
            <li><a href="{{ URL::to('logout') }}"><i class="fa fa-power-off"></i> Logoff</a></li>
          </ul>
          <!-- <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form> -->
        </div>
      </div>
    </nav>

    
    <div class="container-fluid">
      <div class="row">

        @include('includes.menu');

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          
            @yield('content')
          
        </div>
      </div>
    </div>

</body>
@include('includes.footer');
</html>
