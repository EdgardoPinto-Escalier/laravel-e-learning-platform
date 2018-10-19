@extends('layouts.error')


@section('content')
  <div class="container">
    <div class="row centered">
      <div class="col-md-12 text-center">
        <h1 class="mb-3 c500Title"><i class="fas fa-code fa-lg"></i>  LEARN WEB CODE</h1>
        <p class="c500p">OOPS! &nbsp;<i class="fas fa-times-circle"></i>&nbsp; Something went wrong, terribly wrong!</p>
        <p class="c500Code">[ Error code: 500 ]</p>
        <a class="btn btn-primary btn-lg" href="{{ url('/') }}"><i class="fas fa-home"></i>&nbsp; GO BACK HOME</a>
      </div>
    </div>
  </div>
@endsection
