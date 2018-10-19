<!-- First we extend from layouts.app -->
@extends('layouts.app')
<!-- Then we show the jumbotron -->
@section('jumbotron')
    @include('partials.jumbotron', ['title' => 'MY COURSES', 'icon' => 'graduation-cap'], ['subtitle' => 'HERE YOU CAN SEE THE FULL LIST OF THE COURSES I AM ENROLLED TO'])
@endsection
<!-- Here we show the seccion with the content -->
@section('content')
    <div class="pl-5 pr-5">
        <div class="row justify-content-center">
            <!-- Here we create a forelse directive to go through the courses. -->
            @forelse($courses as $course)
                <div class="col-md-3">
                    <!-- Here we show the partial we already have car_course -->
                    @include('partials.courses.card_course')
                </div>
            @empty
                <!-- If the user is not subscribed to any course yet we show this div with a message -->
                <div class="alert btn-primary">
                    <i class="fas fa-info-circle fa-lg"></i>&nbsp;{{ ("You are not enrolled to any course...") }}
                </div>
            @endforelse
        </div>
    </div>
@endsection
