<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Toaq - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="assets/images/logo.svg" type="image/x-icon" />
    <link rel="icon" href="assets/images/logo.svg" type="image/x-icon" />
    <link rel="apple-touch-icon" href="assets/images/logo.svg">
    <meta name="theme-color" content="#ff4c3b" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="">
    <meta name="msapplication-TileImage" content="assets/images/logo.svg">
    <meta name="msappication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200&display=swap" rel="stylesheet">

    <!-- bootstrap css -->
    <link rel="stylesheet" id="rtl-link" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css')}}">

    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/slick.css')}}">

    <!-- iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/iconly.css')}}">

    <!-- Theme css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="{{ asset('assets/css/style.css')}}">

  </head>
        @laravelPWA
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                padding-top: 5%;

                font-family: 'Tajawal', sans-serif;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

        </style>
    </head>
    <body>
        <!-- loader strat -->
        <div class="loader">
          <span></span>
          <span></span>
        </div>
        <!-- loader end -->



        <a href="javascript:void(0)" class="overlay-sidebar"></a>
        <div class="header-sidebar">
          <a href="profile-setting.html" class="user-panel">
            <img src="assets/images/user/4.png" class="img-fluid user-img" alt="">
            <span>ahmed</span>
            <i class="iconly-Arrow-Right-2 icli"></i>
          </a>
          <div class="sidebar-content">
            <ul class="link-section">
{{--
              <li>
                <div>
                  <i class="iconly-Setting icli"></i>
                  <div class="content toggle-sec w-100">
                    <div>
                      <h4 class="mb-0">RTL</h4>
                    </div>
                    <div class="button toggle-btn ms-auto">
                      <input id="rtlButton" type="checkbox" class="checkbox">
                      <div class="knobs">
                        <span></span>
                      </div>
                      <div class="layer"></div>
                    </div>
                  </div>
                </div>
              </li>
            --}}
              <li>
                <a href="pages.html">
                  <i class="iconly-Paper icli"></i>
                  <div class="content">
                    <h4>الصفحات </h4>
                    <h6></h6>
                  </div>
                </a>
              </li>


              <li>
                <a href="profile.html">
                  <i class="iconly-Profile icli"></i>
                  <div class="content">
                    <h4>حسابي</h4>
                    <h6></h6>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="assets/images/flag2.png" class="img-fluid" alt="">
                  <div class="content">
                    <h4>اللغة</h4>
                    <h6></h6>
                  </div>
                </a>
              </li>

              <li>
                <a href="settings.html">
                  <i class="iconly-Setting icli"></i>
                  <div class="content">
                    <h4>الضبط</h4>
                    <h6></h6>
                  </div>
                </a>
              </li>
            </ul>
            <div class="divider"></div>
            <ul class="link-section">
              <li>
                <a href="about-us.html">
                  <i class="iconly-Info-Square icli"></i>
                  <div class="content">
                    <h4>عن المرصد</h4>
                    <h6></h6>
                  </div>
                </a>
              </li>
              <li>
                <a href="help.html">
                  <i class="iconly-Call icli"></i>
                  <div class="content">
                    <h4>الدعم الفني</h4>
                    <h6></h6>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- header end -->
        @yield('content')
        <!-- footer start -->
        <!-- panel space start -->
        <section class="panel-space"></section>
        <!-- panel space end -->


        <!-- bottom panel start -->
        <div class="bottom-panel">
          <ul>
            <li class="active">
              <a href="index.html">
                <div class="icon">
                  <i class="iconly-Home icli"></i>
                  <i class="iconly-Home icbo"></i>
                </div>
                <span>الصفحة الرئيسية</span>
              </a>
            </li>
            <li>
              <a href="category.html">
                <div class="icon">
                  <i class="iconly-Category icli"></i>
                  <i class="iconly-Category icbo"></i>
                </div>
                <span>التصنيفات</span>
              </a>
            </li>

            <li>
              <a href="">
                <div class="icon">
                  <i class="iconly-Heart icli"></i>
                  <i class="iconly-Heart icbo"></i>
                </div>
                <span>مصادري</span>
              </a>
            </li>
            <li>
              <a href="profile.html">
                <div class="icon">
                  <i class="iconly-Profile icli"></i>
                  <i class="iconly-Profile icbo"></i>
                </div>
                <span>حسابي</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- bottom panel end -->


        <!-- pwa install app popup start -->
        <div class="offcanvas offcanvas-bottom addtohome-popup" tabindex="-1" id="offcanvas">
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          <div class="offcanvas-body small">
              {{--
            <div class="app-info">
              <img src="assets/images/logo/logo48.png" class="img-fluid" alt="">
              <div class="content">
                <h3>Multikart App</h3>
                <a href="#">www.multikart-app.com</a>
              </div>
            </div>
             --}}
            <a href="javascript:void(0)" class="btn btn-solid install-app" id="installApp">add to home screen</a>
          </div>
        </div>
        <!-- pwa install app popup end -->


        <!-- latest jquery-->
        <script src="{{ asset('assets/js/jquery-3.3.1.min.js')}}"></script>

        <!-- script js -->
        <script src="{{ asset('assets/js/script.js')}}"></script>

        <!-- Bootstrap js-->
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Slick js-->
        <script src="{{ asset('assets/js/slick.js')}}"></script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '.pagination a', function(event) {
                  event.preventDefault();
                  var page = $(this).attr('href').split('page=')[1];
                  getMoreSources(page);
                });
                $('#search').on('keyup', function() {
                    $value= $(this).val();
                    getMoreSources(1);
                });
            });

            function getMoreSources(page) {
              var search = $('#search').val();

              $.ajax({
                type: "GET",
                data: {
                  'search':search,
                },
                url: "{{ route('search') }}" + "?page=" + page,
                success:function(data) {
                  $('#news_data').html(data);
                }
              });
            }
          </script>
        <script type="text/javascript">
            $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
            type : 'get',
            url : '{{URL::to('search')}}',
            data:{'search':$value},
            success:function(data){
            $('tbody').html(data);
            }
            });
            })
            </script>



        <!-- footer end -->
    </body>
</html>
