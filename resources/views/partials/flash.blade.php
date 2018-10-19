@if(session('flash_message'))
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div class="alert alertFlash font-weight-bold text-uppercase text-center {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
        {{ session('flash_message')}}
      </div>
    </div>
  </div>
@endif
