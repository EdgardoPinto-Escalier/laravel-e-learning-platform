@extends('layouts.app')

@section('jumbotron')
  @include('partials.jumbotron', [
    "title" => ("ACCESS ALL OUR PREMIUM COURSES HERE"),
    "subtitle" => ("HERE YOU CAN FIND THE FULL LIST OF AVAILABLE COURSES"),
     "icon" => "graduation-cap"
  ])
@endsection

@section('content')
<div class="pl-5 pr-5">
    <div class="row justify-content-center">
        @forelse($courses as $course)
            <div class="col-sm-12 col-md-6 col-lg-3">
              @include('partials.courses.card_course')
            </div>
        @empty
            <div class="alert btn-primary">
                <i class="fas fa-info-circle fa-lg"></i>&nbsp;{{ ("There are no courses available at this time...") }}
            </div>
        @endforelse
    </div>

    <div class="row justify-content-center">
        {{ $courses->links() }}
    </div>
</div>
@endsection
