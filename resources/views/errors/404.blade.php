@extends('layouts.error')


@section('content')
  <div class="container">
    <div class="row centered">
      <div class="col-md-12 text-center">
        <h1 class="mb-3 c404Title"><i class="fas fa-code fa-lg"></i>  LEARN WEB CODE</h1>
        <p class="c404p">OOPS! &nbsp;<i class="fas fa-frown"></i>&nbsp; We can't seem to find the page you are looking for...</p>
        <p class="c404Code">[ Error code: 404 ]</p>
        <a class="btn btn-primary btn-lg" href="{{ url('/') }}"><i class="fas fa-home"></i>&nbsp; GO BACK HOME</a>
      </div>
    </div>
  </div>
@endsection
