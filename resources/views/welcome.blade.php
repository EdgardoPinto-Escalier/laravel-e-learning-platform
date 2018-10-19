<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Learn Web Code</title>

        <!-- favicon -->
        <link rel="shortcut icon" href="/images/favicon.ico">
        
        @stack('styles')
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css"
        integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg"
        crossorigin="anonymous">

        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">



    </head>

    <body>
      <div class="full-height">
        <div class="container content">
            <div class="h1 title text-center pt-5">
              <i class="fas fa-code"></i>  LEARN WEB CODE
            </div>

            <div class="mb-5 text-center">
              <p class="h3">YOUR LEARNING PLATFORM ONLINE</p>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="row">

                <div class="col-md-4 welcomeCol">
                  <div class="card text-white mb-3">
                    <div class="card-header"><i class="fas fa-graduation-cap"></i></div>
                    <div class="card-body">
                      <h5 class="card-title">PREMIUM COURSES</h5>
                      <p class="card-text">Whether you're writing your first line of code or transforming your career, start with us and get the technical skills you need to skill up and stand out.</p>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 welcomeCol">
                  <div class="card text-white mb-3">
                    <div class="card-header"><i class="fas fa-bolt"></i></div>
                    <div class="card-body">
                      <h5 class="card-title">BUILD REAL PROJECTS</h5>
                      <p class="card-text">Tired of learning always the same basic and generic concepts? If you join us you'll learn but also build real projects to help you understand better.</p>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 welcomeCol">
                  <div class="card text-white mb-3">
                    <div class="card-header"><i class="fab fa-gripfire"></i></div>
                    <div class="card-body">
                      <h5 class="card-title">LEARN BY DOING</h5>
                      <p class="card-text">The best way to learn is by doing, we have a huge variety of courses where you'll practice programming concepts teaching you solid concepts.</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 my-5 text-center">
                <a href="{{ url('/home') }}" class="btn btnFront"><i class="fas fa-search"></i>&nbsp; CHECK OUR COURSE LIST HERE</a>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 my-3 text-center">
                <ul class="nav nav-fill text-center">
                  <li class="nav-item">
                    <a class="nav-link-pro" href="#"><i class="fab fa-html5"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link-pro" href="#"><i class="fab fa-css3-alt"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link-pro" href="#"><i class="fab fa-js"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link-pro" href="#"><i class="fab fa-angular"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link-pro" href="#"><i class="fab fa-laravel"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link-pro" href="#"><i class="fab fa-react"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link-pro" href="#"><i class="fab fa-php"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link-pro" href="#"><i class="fab fa-python"></i></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link-pro" href="#"><i class="fab fa-vuejs"></i></a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 my-5 text-center">
                <ul class="nav justify-content-center">
                  <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/about') }}">ABOUT</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/contact') }}">CONTACT</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/login') }}">LOGIN</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/register') }}">REGISTER</a>
                  </li>
                </ul>
              </div>
            </div>
        </div>
      </div>
    </body>
</html>
