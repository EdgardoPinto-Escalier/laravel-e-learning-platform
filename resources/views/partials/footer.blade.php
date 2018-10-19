<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm text-white text-center">
               <i class="far fa-copyright"></i>&nbsp;<?php echo date("Y"); ?>&nbsp;
               <i class="fas fa-code fa-lg"></i>&nbsp; {{ __(":name - All rights reserved", ['name' => config('app.name')]) }}
            </div>
        </div>

        <div class="row">
          <div class="col-md-12 my-5 text-center">
            <ul class="nav justify-content-center">
              <li class="nav-item">
                <a class="nav-link footerLink active" href="{{ url('/about') }}">ABOUT</a>
              </li>
              <li class="nav-item">
                <a class="nav-link footerLink active" href="{{ url('/contact') }}">CONTACT</a>
              </li>
              <li class="nav-item">
                <a class="nav-link footerLink active" href="{{ url('/login') }}">LOGIN</a>
              </li>
              <li class="nav-item">
                <a class="nav-link footerLink active" href="{{ url('/register') }}">REGISTER</a>
              </li>
            </ul>
          </div>
        </div>
    </div>
</footer>
