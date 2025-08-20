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
    <link rel="stylesheet" href="{{asset('design/assets/libs/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <style>
        .slick-prev:before, .slick-next:before { 
            color:green !important;
        }
      .slick-track
      {
        margin-left:0px !important;
      }
        .renz {
          transition: filter 0.3s ease, color 0.3s ease;
        }
        .renz:hover {
          filter: sepia(1) saturate(6) hue-rotate(100deg) brightness(.8);
        }
        .filter-green:hover {
          filter: grayscale(100%) brightness(0%);
        }

            .move-up {
                margin-top: -25px; /* Adjust the negative value to move the icon up */
                margin-left: -70px; /* Adjust the negative value to move the icon up */
            }
            .move-left {
                margin-top: -40px; /* Adjust the negative value to move the icon up */
                margin-left: 40px; /* Adjust the negative value to move the icon up */
            }
            .green-icon {
              filter: invert(30%) sepia(60%) saturate(500%) hue-rotate(120deg);

            }
            .filter-rgb {
              /* filter: grayscale(100%) brightness(0%) saturate(120%) contrast(121%); */
              opacity: 0.3 !important;
          }
          .font{
            font-size:15px;
          }

          /* Default (large screens) */
    body {
        font-size: 18px;
    }

    /* Small screens (Mobile) */
    @media (max-width: 480px) {
      .font {
            font-size: 8px;  /* Even smaller font size for small screens */
            
        }
        
    }

    /* Medium screens (Tablets) */
    @media (max-width: 768px) {
      .font {
            font-size: 12px;  /* Smaller font size for medium screens */
        }

      
    }

    /* Larger tablets / small laptops */
    @media (max-width: 1024px) {
      .move-up {
                margin-top: -25px; /* Adjust the negative value to move the icon up */
                margin-left: -20px; /* Adjust the negative value to move the icon up */
            }
      
    }

    /* Large screens (Desktops and bigger) */



    /* For screens with a minimum width of 768px (medium to large screens) */


</style>
  
    @yield('css')
       
    <style>
      .loader {
          position: fixed;
          left: 0px;
          top: 0px;
          width: 100%;
          height: 100%;
          z-index: 9999;
          background: url("{{ asset('/images/loader.gif') }}") 50% 50% no-repeat white;
          opacity: .8;
          background-size: 120px 120px;
      }
      .footer {
          border-top: 1px solid #e9ecef;
          padding: 2rem 0 1.5rem 0;
          margin-top: 170px;
          margin-left: 0;
          width: 100%;
          background: none;
      }

      .page-wrapper .footer {
          position: relative;
          width: 100%;
      }

      .footer .container-fluid {
          padding-left: 1rem;
          padding-right: 1rem;
      }

      .footer .footer-content {
          display: flex;
          flex-direction: column;
          align-items: center;
          gap: 1.5rem;
          position: relative;
      }

      .footer .company-info {
          display: flex;
          align-items: center;
          gap: 0.75rem;
          position: absolute;
          left: 0;
          top: 0;
      }


      .footer-right-image img {
        position: absolute; 
        width: 150px; /* Adjust size as needed */
        height: auto;
        margin-left: 435px;
        margin-top: -43px;
      }

      @media (max-width: 768px) {
         .footer-right-image img {
           margin-left: -75px;
           margin-top: -2px;
        }

        .footer-right-image {
          margin-top: 1rem;
        }
      }


      .footer .nav-links-container {
          display: flex;
          flex-direction: column;
          align-items: center;
          gap: 0.4rem;
          margin-top: 0;
      }
      .footer .company-logo img {
          width: 350px !important;
          height: 70px !important;
      }

      .footer .company-logo {
          width: 24px;
          height: 24px;
          border-radius: 4px;
          margin-left: 80px; 
          display: flex;
          align-items: center;
          justify-content: center;
          color: white;
          font-weight: bold;
          font-size: 12px;
      }

      @media (max-width: 768px) {
         .footer .company-logo img {
           margin-left: -57px;
           margin-top: -5px;
        }
      }

      .footer .company-text {
          color: #6c757d;
          font-size: 14px;
          margin: 0;
      }

      .footer .nav-links {
          display: flex;
          gap: 2rem;
          margin: 0;
          padding: 0;
          list-style: none;
          flex-wrap: wrap;
          justify-content: center;
      }

      .footer .nav-links a {
          color: #6c757d;
          text-decoration: none;
          font-size: 14px;
          transition: color 0.2s ease;
          font-weight: 500;
      }

      .footer .nav-links a:hover {
          color: #2e7fe1ff;
      }

      .footer .divider {
          width: 100%;
          max-width: 300px;
          height: 1px;
          background-color: #e9ecef;
          margin: 0.5rem 0;
      }

      .footer .social-links {
          display: flex;
          gap: 1.5rem;
          margin: 0;
          padding: 0;
          list-style: none;
      }

      .footer .social-links a {
          color: #6c757d;
          font-size: 20px;
          transition: color 0.2s ease;
          display: flex;
          align-items: center;
          justify-content: center;
      }

      .footer .social-links a:hover {
          color: #2e7fe1ff;
      }

      @media (max-width: 768px) {
          .footer .company-info {
              position: static;
              align-self: center;
              margin-bottom: 1rem;
          }
          
          .footer .footer-content {
              align-items: center;
          }
          
          .footer .nav-links-container {
              margin-top: 0;
          }
          
          .footer .nav-links {
              gap: 1.5rem;
          }
          
          .footer .nav-links a {
              font-size: 13px;
          }
          
          .footer .social-links {
              gap: 1rem;
          }
          
          .footer .social-links a {
              font-size: 18px;
          }
      }

      @media (max-width: 480px) {
          .footer .nav-links {
              gap: 1rem;
          }
          
          .footer .nav-links a {
              font-size: 12px;
          }
      }
    </style>
</head>
<body>
  <div id="loader" style="display:none;" class="loader">
  </div>
    <div class="preloader">
        <img
          src="{{asset('design/assets/images/logos/loader.svg')}}"
          alt="loader"
          class="lds-ripple img-fluid"
        />
      </div>
      <div id="main-wrapper">
        <!-- Sidebar Start -->
        <aside class="left-sidebar with-vertical">
          <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="brand-logo d-flex align-items-center justify-content-between text-center">
      <a href="{{url('/')}}" class="text-nowrap logo-img text-center">
        <!-- Full logo for expanded sidebar -->
        <img src="{{asset('images/logo_mo.png')}}" 
            style='height:55px;width:178px;' 
            class="dark-logo text-center logo-full" 
            alt="Logo-Dark" />
        
        <!-- Mini logo for collapsed sidebar (initially hidden) -->
        <img src="{{asset('images/logo_nya.png')}}" 
            style='height:43px;width:43px;display:none;' 
            class="dark-logo text-center logo-mini" 
            alt="Logo-Mini" />
      </a>
      <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
        <i class="ti ti-x"></i>
      </a>
    </div>
    
    <div class="scroll-sidebar" data-simplebar>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
        <ul id="sidebarnav" class="mb-0">
    
          <!-- ============================= -->
          <!-- Home -->
          <!-- ============================= -->
        
          <li class="nav-small-cap">
            <iconify-icon icon="solar:menu-dots-bold-duotone" class="nav-small-cap-icon fs-5"></iconify-icon>
            <span class="hide-menu">Home</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link sidebar-link primary-hover-bg @if(Route::currentRouteName() == 'home')active @endif" href="{{url('/')}}" aria-expanded="false">
              <span class="aside-icon p-2 bg-primary-subtle rounded-1">
                <iconify-icon icon="solar:screencast-2-line-duotone" class="fs-6"></iconify-icon>
              </span>
              <span class="hide-menu ps-1">Dashboard</span>
            </a>
          </li>
          @if((auth()->user()->role == "Admin") || (auth()->user()->role == "Dealer"))
          <li class="sidebar-item">
            <a class="sidebar-link sidebar-link primary-hover-bg @if(Route::currentRouteName() == 'transactions')active @endif" href="{{url('/transactions')}}" aria-expanded="false">
              <span class="aside-icon p-2 bg-primary-subtle rounded-1">
                <iconify-icon icon="mdi:currency-usd" class="fs-6"></iconify-icon>


              </span>
              <span class="hide-menu ps-1">Transactions</span>
            </a>
          </li>
          @endif
           @if((auth()->user()->role == "Admin"))
          <li class="sidebar-item">
            <a class="sidebar-link sidebar-link primary-hover-bg @if(Route::currentRouteName() == 'Dealers')active @endif" href="{{url('/dealers')}}" aria-expanded="false">
              <span class="aside-icon p-2 bg-primary-subtle rounded-1">
                <iconify-icon icon="mdi:store" class="fs-6"></iconify-icon>


              </span>
              <span class="hide-menu ps-1">Dealers</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link sidebar-link primary-hover-bg @if(Route::currentRouteName() == 'Customers')active @endif" href="{{url('/customers')}}" aria-expanded="false">
              <span class="aside-icon p-2 bg-primary-subtle rounded-1">
                <iconify-icon icon="mdi:account" class="fs-6"></iconify-icon>



              </span>
              <span class="hide-menu ps-1">Customers</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link sidebar-link primary-hover-bg @if(Route::currentRouteName() == 'Users')active @endif" href="{{url('/users')}}" aria-expanded="false">
              <span class="aside-icon p-2 bg-primary-subtle rounded-1">
                <iconify-icon icon="mdi:cog" class="fs-6"></iconify-icon>



              </span>
              <span class="hide-menu ps-1">Users</span>
            </a>
          </li>
          @endif
          {{-- <li class="nav-small-cap">
            <iconify-icon icon="solar:menu-dots-bold-duotone" class="nav-small-cap-icon fs-5"></iconify-icon>
            <span class="hide-menu">Dealer</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link sidebar-link primary-hover-bg @if(Route::currentRouteName() == 'dashboard-dealer')active @endif" href="{{url('/dashboard-dealer')}}" aria-expanded="false">
              <span class="aside-icon p-2 bg-primary-subtle rounded-1">
                <iconify-icon icon="solar:screencast-2-line-duotone" class="fs-6"></iconify-icon>
              </span>
              <span class="hide-menu ps-1">Dashboard</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link sidebar-link primary-hover-bg @if(Route::currentRouteName() == 'dealer=transactions')active @endif" href="{{url('/dealer=transactions')}}" aria-expanded="false">
              <span class="aside-icon p-2 bg-primary-subtle rounded-1">
                <iconify-icon icon="mdi:currency-usd" class="fs-6"></iconify-icon>


              </span>
              <span class="hide-menu ps-1">Transactions</span>
            </a>
          </li>
          <li class="nav-small-cap">
            <iconify-icon icon="solar:menu-dots-bold-duotone" class="nav-small-cap-icon fs-5"></iconify-icon>
            <span class="hide-menu">Customer</span>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link sidebar-link primary-hover-bg @if(Route::currentRouteName() == 'dashboard-customer')active @endif" href="{{url('/dashboard-customer')}}" aria-expanded="false">
              <span class="aside-icon p-2 bg-primary-subtle rounded-1">
                <iconify-icon icon="solar:screencast-2-line-duotone" class="fs-6"></iconify-icon>
              </span>
              <span class="hide-menu ps-1">Dashboard</span>
            </a>
          </li> --}}
          <!-- ============================= -->
          <!-- Apps -->
          <!-- ============================= -->
        
        </ul>
    
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    
    <div class=" fixed-profile mx-3 mt-3">
      <div class="card bg-primary-subtle mb-0 shadow-none">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
              <img src="{{auth()->user()->avatar}}" onerror="this.src='{{url('design/assets/images/profile/user-1.png')}}';" width="45" height="45" class="img-fluid rounded-circle" alt="" />
              <div>
                <h5 class="mb-1">{{current(explode(' ',auth()->user()->name))}}</h5>
              </div>
            </div>
            <a href="{{ route('logout') }}" onclick="logout(); show();" class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
              data-bs-title="Logout">
              <iconify-icon icon="solar:logout-line-duotone" class="fs-8"></iconify-icon>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
        </aside>
        <!--  Sidebar End -->
        <div class="page-wrapper">
    
          <aside class="left-sidebar with-horizontal">
            <!-- Sidebar scroll-->
   
          </aside>
    
          <div class="body-wrapper">
            <div class="container-fluid">
              <!--  Header Start -->
              <header class="topbar sticky-top">
                <div class="with-vertical"><!-- ---------------------------------- -->
    <!-- Start Vertical Layout Header -->
    <!-- ---------------------------------- -->
    <nav class="navbar navbar-expand-lg p-0">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
            <div class="nav-icon-hover-bg rounded-circle ">
              <iconify-icon icon="solar:list-bold-duotone" class="fs-7 text-dark"></iconify-icon>
            </div>
          </a>
        </li>
      </ul>
    
     
    
      <div class="d-block d-lg-none">
        {{-- <img src="{{asset('images/icon.png')}}" class="dark-logo" alt="Logo-Dark" />
        <img src="{{asset('images/icon.png')}}" class="light-logo" alt="Logo-light" /> --}}
      </div>
    
    
      <a class="navbar-toggler nav-icon-hover p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="p-2">
          <i class="ti ti-dots fs-7"></i>
        </span>
      </a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="d-flex align-items-center justify-content-between">
          <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center"
            type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
            aria-controls="offcanvasWithBothOptions">
            <div class="nav-icon-hover-bg rounded-circle ">
              <i class="ti ti-align-justified fs-7"></i>
            </div>
          </a>
          <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
            <li class="nav-item dropdown d-block d-lg-none">
              <a class="nav-link position-relative" href="javascript:void(0)" id="drop3" data-bs-toggle="dropdown"
                aria-expanded="false">
                <iconify-icon icon="solar:magnifer-linear" class="fs-7 text-dark"></iconify-icon>
              </a>
              <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop3">
                <!--  Search Bar -->
            
            <div class="modal-header border-bottom p-3">
            <input type="search" class="form-control fs-3" placeholder="Try to searching ..." />
            <span data-bs-dismiss="modal" class="lh-1 cursor-pointer">
                <i class="ti ti-x fs-5 ms-3"></i>
            </span>
            </div>
              </div>
            </li>
            <!-- ------------------------------- -->
            <!-- start language Dropdown -->
            <!-- ------------------------------- -->
           
            <!-- ------------------------------- -->
            <!-- end language Dropdown -->
            <!-- ------------------------------- -->
    
           
    
            <!-- ------------------------------- -->
            <!-- start Messages cart Dropdown -->
            <!-- ------------------------------- -->
            
            <!-- ------------------------------- -->
            <!-- end Messages cart Dropdown -->
            <!-- ------------------------------- -->
    
            <!-- ------------------------------- -->
            <!-- start notification Dropdown -->
            <!-- ------------------------------- -->
           
            <!-- ------------------------------- -->
            <!-- end notification Dropdown -->
            <!-- ------------------------------- -->
    
            <!-- ------------------------------- -->
            <!-- start profile Dropdown -->
            <!-- ------------------------------- -->
            <li class="nav-item dropdown">
              <a class="nav-link position-relative ms-6" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                aria-expanded="false">
                <div class="d-flex align-items-center flex-shrink-0">
                  <div class="user-profile me-sm-3 me-2">
                    <img src="{{auth()->user()->avatar}}" onerror="this.src='{{url('design/assets/images/profile/user-1.png')}}';" width="45" height='100%' class="rounded-circle" alt="">
                  </div>
                  <span class="d-sm-none d-block"><iconify-icon
                      icon="solar:alt-arrow-down-line-duotone"></iconify-icon></span>
    
                  <div class="d-none d-sm-block">
                    <h6 class="fw-bold fs-4 mb-1 profile-name">
                        {{current(explode(' ',auth()->user()->name))}}
                    </h6>
                    <p class="fs-3 lh-base mb-0 profile-subtext">
                      
                    </p>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                <div class="profile-dropdown position-relative" data-simplebar>
      <div class="d-flex align-items-center justify-content-between pt-3 px-7">
        <h3 class="mb-0 fs-5">User Profile</h3>
        <button type="button" class="border-0 bg-transparent" aria-label="Close">
          <iconify-icon icon="solar:close-circle-line-duotone" class="fs-7 text-muted"></iconify-icon>
        </button>
      </div>
    
      <div class="d-flex align-items-center mx-7 py-9 border-bottom">
        <img src="{{auth()->user()->avatar}}" onerror="this.src='{{url('design/assets/images/profile/user-1.png')}}';" alt="user" width="100" class="rounded-circle" />
        <div class="ms-4">
          <h4 class="mb-0 fs-5 fw-normal">{{auth()->user()->name}}</h4>
          <span class="text-muted"></span>
          <p class="text-muted mb-0 mt-1 d-flex align-items-center">
            <iconify-icon icon="solar:mailbox-line-duotone" class="fs-4 me-1"></iconify-icon>
            {{auth()->user()->email}}
          </p>
        </div>
      </div>
    
      <div class="message-body">
        @if(auth()->user()->role != "Admin")
        <a href="{{url('user-profile')}}" class="dropdown-item px-7 d-flex align-items-center py-6">
          <span class="btn px-3 py-2 bg-info-subtle rounded-1 text-info shadow-none">
            <iconify-icon icon="solar:wallet-2-line-duotone" class="fs-7"></iconify-icon>
          </span>
          <div class="w-75 d-inline-block v-middle ps-3 ms-1">
            <h5 class="mb-0 mt-1 fs-4 fw-normal">
              My Profile
            </h5>
            <span class="fs-3 text-nowrap d-block fw-normal mt-1 text-muted">Account Settings</span>
          </div>
        </a>
        @endif
    
      </div>
    
      <div class="py-6 px-7 mb-1">
        <a href="" class="btn btn-primary w-100">Log Out</a>
      </div>
    </div>
              </div>
            </li>
            <!-- ------------------------------- -->
            <!-- end profile Dropdown -->
            <!-- ------------------------------- -->
          </ul>
        </div>
      </div>
    </nav>
    <!-- ---------------------------------- -->
    <!-- End Vertical Layout Header -->
    <!-- ---------------------------------- -->
    
    <!-- ------------------------------- -->
    <!-- apps Dropdown in Small screen -->
    <!-- ------------------------------- -->
    <!--  Mobilenavbar -->
    <div class="offcanvas offcanvas-start dropdown-menu-nav-offcanvas" data-bs-scroll="true" tabindex="-1" id="mobilenavbar"
      aria-labelledby="offcanvasWithBothOptionsLabel">
      <nav class="sidebar-nav scroll-sidebar">
        <div class="offcanvas-header justify-content-between">
          {{-- <img src="{{asset('images/icon.png')}}" alt="" class="img-fluid" /> --}}
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body h-n80" data-simplebar>
        
        </div>
      </nav>
    </div></div>
                <div class="app-header with-horizontal">
                  <nav class="navbar navbar-expand-xl container-fluid p-0">
     
      <a class="navbar-toggler nav-icon-hover p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="p-2">
          <i class="ti ti-dots fs-7"></i>
        </span>
      </a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="d-flex align-items-center justify-content-between">
          <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center"
            type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
            aria-controls="offcanvasWithBothOptions">
            <div class="nav-icon-hover-bg rounded-circle ">
              <i class="ti ti-align-justified fs-7"></i>
            </div>
          </a>
          <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
            <li class="nav-item dropdown d-block d-lg-none">
              <a class="nav-link position-relative" href="javascript:void(0)" id="drop3" data-bs-toggle="dropdown"
                aria-expanded="false">
                <iconify-icon icon="solar:magnifer-linear" class="fs-7 text-dark"></iconify-icon>
              </a>
              <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop3">
                <!--  Search Bar -->
    
    <div class="modal-header border-bottom p-3">
      <input type="search" class="form-control fs-3" placeholder="Try to searching ..." />
      <span data-bs-dismiss="modal" class="lh-1 cursor-pointer">
        <i class="ti ti-x fs-5 ms-3"></i>
      </span>
    </div>
   
              </div>
            </li>
            <!-- ------------------------------- -->
            <!-- start language Dropdown -->
            <!-- ------------------------------- -->
           
            <!-- ------------------------------- -->
            <!-- end notification Dropdown -->
            <!-- ------------------------------- -->
    
            <!-- ------------------------------- -->
            <!-- start profile Dropdown -->
            <!-- ------------------------------- -->
            
            <!-- ------------------------------- -->
            <!-- end profile Dropdown -->
            <!-- ------------------------------- -->
          </ul>
        </div>
      </div>
    </nav>
                </div>
              </header>
              @yield('content')
              <!--  Header End -->
            <footer class="footer">
              <div class="container-fluid">
                <div class="footer-content">
                  
                  <!-- Left-aligned Logo -->
                  <div class="company-info">
                    <div class="company-logo">
                      <img src="{{ asset('images/footer.png') }}" alt="Company Logo" />
                    </div>
                  </div>

                  <!-- Center Nav + Social -->
                  <div class="nav-links-container">
                    <nav>
                      <ul class="nav-links">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('product.index') }}">Product</a></li>
                        <li><a href="{{ route('storelocation') }}">Store Location</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                      </ul>
                    </nav>

                    <div class="divider"></div>

                    <div class="social-links">
                      <a href="https://www.tiktok.com/@gazliteofficial" aria-label="Tiktok">
                        <iconify-icon icon="simple-icons:tiktok"></iconify-icon>
                      </a>
                      <a href="https://www.instagram.com/gazliteph/#" aria-label="Instagram">
                        <iconify-icon icon="mdi:instagram"></iconify-icon>
                      </a>
                      <a href="https://www.facebook.com/GazLitePH/" aria-label="Facebook">
                        <iconify-icon icon="mdi:facebook"></iconify-icon>
                      </a>
                    </div>
                      <div class="footer-right-image">
                    <img src="{{ asset('images/footer1.png') }}" alt="Right Footer Image" />
                  </div>
                  </div>
                
                </div>
                
              </div>
            </footer>

            </div>
          </div>
          <script>
      function handleColorTheme(e) {
        $("html").attr("data-color-theme", e);
        $(e).prop("checked", !0);
      }
    </script>
    {{-- <button class="btn btn-primary p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn"
      type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
      <i class="icon ti ti-settings fs-7"></i>
    </button> --}}
    
    <div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample"
      aria-labelledby="offcanvasExampleLabel">
      <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
        <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">
          Settings
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body h-n80" data-simplebar>
        <h6 class="fw-semibold fs-4 mb-2">Theme</h6>
    
        <div class="d-flex flex-row gap-3 customizer-box" role="group">
          <input type="radio" class="btn-check light-layout" name="theme-layout" id="light-layout" autocomplete="off" />
          <label class="btn p-9 btn-outline-primary" for="light-layout"><i
              class="icon ti ti-brightness-up fs-7 me-2"></i>Light</label>
    
          <input type="radio" class="btn-check dark-layout" name="theme-layout" id="dark-layout" autocomplete="off" />
          <label class="btn p-9 btn-outline-primary" for="dark-layout"><i class="icon ti ti-moon fs-7 me-2"></i>Dark</label>
        </div>
    
        <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Direction</h6>
        <div class="d-flex flex-row gap-3 customizer-box" role="group">
          <input type="radio" class="btn-check" name="direction-l" id="ltr-layout" autocomplete="off" />
          <label class="btn p-9 btn-outline-primary" for="ltr-layout"><i
              class="icon ti ti-text-direction-ltr fs-7 me-2"></i>LTR</label>
    
          <input type="radio" class="btn-check" name="direction-l" id="rtl-layout" autocomplete="off" />
          <label class="btn p-9 btn-outline-primary" for="rtl-layout"><i
              class="icon ti ti-text-direction-rtl fs-7 me-2"></i>RTL</label>
        </div>
    
        <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Colors</h6>
    
        <div class="d-flex flex-row flex-wrap gap-3 customizer-box color-pallete" role="group">
          <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme"
            autocomplete="off" />
          <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Blue_Theme')"
            for="Blue_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="BLUE_THEME">
            <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
              <i class="ti ti-check text-white d-flex icon fs-5"></i>
            </div>
          </label>
    
          <input type="radio" class="btn-check" name="color-theme-layout"  id="Aqua_Theme"
            autocomplete="off" />
          <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Aqua_Theme')"
            for="Aqua_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="AQUA_THEME">
            <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
              <i class="ti ti-check text-white d-flex icon fs-5"></i>
            </div>
          </label>
    
          <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme" autocomplete="off" />
          <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Purple_Theme')"
            for="Purple_Theme" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="PURPLE_THEME">
            <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
              <i class="ti ti-check text-white d-flex icon fs-5"></i> 
            </div>
          </label>
    
          <input type="radio" class="btn-check" name="color-theme-layout" id="green-theme-layout" autocomplete="off" />
          <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Green_Theme')"
            for="green-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="GREEN_THEME">
            <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
              <i class="ti ti-check text-white d-flex icon fs-5"></i>
            </div>
          </label>
    
          <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout" autocomplete="off" />
          <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Cyan_Theme')"
            for="cyan-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="CYAN_THEME">
            <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
              <i class="ti ti-check text-white d-flex icon fs-5"></i>
            </div>
          </label>
    
          <input type="radio" class="btn-check" name="color-theme-layout" id="orange-theme-layout" autocomplete="off" />
          <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center" onclick="handleColorTheme('Orange_Theme')"
            for="orange-theme-layout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="ORANGE_THEME">
            <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-6">
              <i class="ti ti-check text-white d-flex icon fs-5"></i>
            </div>
          </label>
        </div>
    
        <h6 class="mt-5 fw-semibold fs-4 mb-2">Layout Type</h6>
        <div class="d-flex flex-row gap-3 customizer-box" role="group">
          <div>
            <input type="radio" class="btn-check" name="page-layout" id="vertical-layout" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary" for="vertical-layout"><i
                class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Vertical</label>
          </div>
          <div>
            <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary" for="horizontal-layout"><i
                class="icon ti ti-layout-navbar fs-7 me-2"></i>Horizontal</label>
          </div>
        </div>
    
        <h6 class="mt-5 fw-semibold fs-4 mb-2">Container Option</h6>
    
        <div class="d-flex flex-row gap-3 customizer-box" role="group">
          <input type="radio" class="btn-check" name="layout" id="boxed-layout" autocomplete="off" />
          <label class="btn p-9 btn-outline-primary" for="boxed-layout"><i
              class="icon ti ti-layout-distribute-vertical fs-7 me-2"></i>Boxed</label>
    
          <input type="radio" class="btn-check" name="layout" id="full-layout" autocomplete="off" />
          <label class="btn p-9 btn-outline-primary" for="full-layout"><i
              class="icon ti ti-layout-distribute-horizontal fs-7 me-2"></i>Full</label>
        </div>
    
        <h6 class="fw-semibold fs-4 mb-2 mt-5">Sidebar Type</h6>
        <div class="d-flex flex-row gap-3 customizer-box" role="group">
          <a href="javascript:void(0)" class="fullsidebar">
            <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary" for="full-sidebar"><i
                class="icon ti ti-layout-sidebar-right fs-7 me-2"></i>Full</label>
          </a>
          <div>
            <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar" autocomplete="off" />
            <label class="btn p-9 btn-outline-primary" for="mini-sidebar"><i
                class="icon ti ti-layout-sidebar fs-7 me-2"></i>Collapse</label>
          </div>
        </div>
    
        <h6 class="mt-5 fw-semibold fs-4 mb-2">Card With</h6>
    
        <div class="d-flex flex-row gap-3 customizer-box" role="group">
          <input type="radio" class="btn-check" name="card-layout" id="card-with-border" autocomplete="off" />
          <label class="btn p-9 btn-outline-primary" for="card-with-border"><i
              class="icon ti ti-border-outer fs-7 me-2"></i>Border</label>
    
          <input type="radio" class="btn-check" name="card-layout" id="card-without-border" autocomplete="off" />
          <label class="btn p-9 btn-outline-primary" for="card-without-border"><i
              class="icon ti ti-border-none fs-7 me-2"></i>Shadow</label>
        </div>
      </div>
    </div>
        </div>
        <div class="dark-transparent sidebartoggler"></div>
      </div>
      @include('sweetalert::alert')
    {{-- <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div> --}}
    <script>
            function logout() {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
    
    </script>
  
    <script src="{{asset('design/assets/js/vendor.min.js')}}"></script>
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

  @yield('javascript')
  
  <script>
    // Replace the existing logo switching script with this improved version
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggler = document.getElementById('headerCollapse');
    const mainWrapper = document.getElementById('main-wrapper');
    const sidebar = document.querySelector('.left-sidebar');
    const logoFull = document.querySelector('.logo-full');
    const logoMini = document.querySelector('.logo-mini');
    
    console.log('Logo switching script loaded');
    console.log('Elements found:', {
        sidebarToggler: !!sidebarToggler,
        mainWrapper: !!mainWrapper,
        sidebar: !!sidebar,
        logoFull: !!logoFull,
        logoMini: !!logoMini
    });
    
    // Function to switch logos based on sidebar width
    function switchLogo() {
        if (!sidebar || !logoFull || !logoMini) return;
        
        // Get the computed width of the sidebar
        const sidebarWidth = sidebar.offsetWidth;
        console.log('Sidebar width:', sidebarWidth);
        
        // Check various possible class names and width
        const isCollapsed = sidebarWidth < 100 || 
                           mainWrapper.classList.contains('mini-sidebar') ||
                           mainWrapper.classList.contains('sidebar-mini') ||
                           mainWrapper.classList.contains('collapsed') ||
                           sidebar.classList.contains('mini-sidebar') ||
                           sidebar.classList.contains('collapsed');
        
        console.log('Is collapsed:', isCollapsed);
        
        if (isCollapsed) {
            // Show mini logo, hide full logo
            logoFull.style.display = 'none';
            logoMini.style.display = 'block';
            console.log('Switched to mini logo');
        } else {
            // Show full logo, hide mini logo
            logoFull.style.display = 'block';
            logoMini.style.display = 'none';
            console.log('Switched to full logo');
        }
    }
    
    // Listen for sidebar toggle clicks
    if (sidebarToggler) {
        sidebarToggler.addEventListener('click', function() {
            console.log('Sidebar toggler clicked');
            // Try multiple delays to catch the animation
            setTimeout(switchLogo, 50);
            setTimeout(switchLogo, 150);
            setTimeout(switchLogo, 300);
            setTimeout(switchLogo, 500);
        });
    }
    
    // Also listen for clicks on the sidebar itself (some themes have multiple togglers)
    document.addEventListener('click', function(e) {
        if (e.target.closest('.sidebartoggler') || e.target.closest('[data-toggle="sidebar"]')) {
            console.log('Alternative sidebar toggle clicked');
            setTimeout(switchLogo, 100);
            setTimeout(switchLogo, 300);
        }
    });
    
    // Watch for class changes on main wrapper and sidebar
    const observerConfig = {
        attributes: true,
        attributeFilter: ['class', 'style']
    };
    
    if (mainWrapper) {
        const mainObserver = new MutationObserver(function(mutations) {
            console.log('Main wrapper class changed');
            switchLogo();
        });
        mainObserver.observe(mainWrapper, observerConfig);
    }
    
    if (sidebar) {
        const sidebarObserver = new MutationObserver(function(mutations) {
            console.log('Sidebar class/style changed');
            switchLogo();
        });
        sidebarObserver.observe(sidebar, observerConfig);
    }
    
    // Watch for window resize (in case it affects sidebar)
    window.addEventListener('resize', function() {
        setTimeout(switchLogo, 100);
    });
    
    // Initial check
    setTimeout(switchLogo, 500);
    
    // Fallback: Check periodically for the first few seconds
    let checkCount = 0;
    const intervalCheck = setInterval(function() {
        switchLogo();
        checkCount++;
        if (checkCount > 10) {
            clearInterval(intervalCheck);
        }
    }, 500);
});
  </script>
  <script>
      function show() {
            document.getElementById("loader").style.display = "block";
        }
    function error(error)
    {
      Swal.fire({
        type: "error",
        title: "Error",
        text: error,
      });
    }
  </script>

</body>
</html>