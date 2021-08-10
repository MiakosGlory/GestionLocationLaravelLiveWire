<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>New App</title>

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        @livewireStyles

    </head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    <!------------------------- Navbar ------------------------>
                          @include('component.navbar');

    <!-------------------------- Menu --------------------------->
                          @include('component.menu');


    <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
          @yield("content")
      </div>
    </div>
    </div>

    <!------------------------ Aside Bar ---------------------->
                    @include('component.sidebar');


    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
          Anything you want
        </div>
        <strong>Copyright &copy; 2021 <a href="https://adminlte.io">MIAGVISION</a>.</strong> Tout droits reservés.
    </footer>
  </div>

<script src="{{asset('js/app.js')}}"></script>
@livewireScripts
</body>
</html>