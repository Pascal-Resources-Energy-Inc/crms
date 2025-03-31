<!DOCTYPE html>
<html  lang="en"  dir="ltr" data-bs-theme="light" data-color-theme="Green_Theme" data-layout="vertical">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Required meta tags -->
        <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{asset('images/icon.png')}}" />

    <!-- Core Css -->
    <link rel="stylesheet" href="{{asset('design/assets/css/styles.css')}}" />

    <!-- <title>Spike Bootstrap Admin</title> -->
</head>
<body>
    <div class="preloader">
        <img
          src="{{asset('design/assets/images/logos/loader.svg')}}"
          alt="loader"
          class="lds-ripple img-fluid"
        />
      </div>
      <div id="main-wrapper" class="p-0 bg-white">
        <div
          class="auth-login position-relative overflow-hidden d-flex align-items-center justify-content-center px-7 px-xxl-0 rounded-3 h-n20"
        >
          <div class="auth-login-shape position-relative w-100">
            <div
              class="auth-login-wrapper card mb-0 container position-relative z-1 h-100 max-h-770"
              data-simplebar
            >
              <div class="card-body mt-5">
               
                <div
                  class="row align-items-center justify-content-around pt-6 pb-5"
                >
                  <div class="col-lg-6 col-xl-5 d-none d-lg-block">
                    <div class="text-center text-lg-start">
                      <img 
                        src="{{asset('images/bg.jpg')}}"
                        alt=""
                        class="img-fluid"
                      />
                    </div>
                  </div>
                  <div class="col-lg-6 col-xl-5">
                  @yield('content')
                  </div>
                </div>
              </div>
            </div>
           
          </div>
        </div>
        <div class="light-transparent sidebartoggler"></div>
      </div>
    {{-- <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div> --}}
  
    <script src="{{asset('design/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('design/assets/libs/simplebar/dist/simplebar.min.js')}}"></script>
    <script src="{{asset('design/assets/js/theme/app.init.js')}}"></script>
    <script src="{{asset('design/assets/js/theme/theme.js')}}"></script>
    <script src="{{asset('design/assets/js/theme/app.min.js')}}"></script>
    <script src="{{asset('design/assets/js/theme/sidebarmenu.js')}}"></script>
    <script src="{{asset('design/assets/js/theme/feather.min.js')}}"></script>
    {{-- <script >
        window.onload = function() {
            var userImage = document.getElementById("light-layout");
            userImage.click();
        };
    </script> --}}
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>
</html>
