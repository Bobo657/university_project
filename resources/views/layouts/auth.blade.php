
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <!-- Meta tags  -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta content="We craft digital experiences that embrace the unexpected, simplify the complex, and create genuine connection between brands and their audiences." name="description" />  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name')}} - @yield('title') </title>
    <link rel="icon" type="image/png" href="{{ env('APP_URL') }}/img/favicon.ico" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/app.css" />

    <!-- Javascript Assets -->
    <script src="{{ env('APP_URL') }}/js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
      rel="stylesheet"
    />
  </head>
  <body x-data class="is-header-blur" x-bind="$store.global.documentBody">
    <!-- App preloader-->
    {{-- <div
      class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900"
    >
      <div class="app-preloader-inner relative inline-block h-48 w-48"></div>
    </div> --}}

    <!-- Page Wrapper -->
    
     @yield('content')
    <!-- 
        This is a place for Alpine.js Teleport feature 
        @see https://alpinejs.dev/directives/teleport
      -->
    <div id="x-teleport-target"></div>
    <script>
      window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
  </body>
</html>
