@extends('layouts.app')

@section('jumbotron')
  @include('partials.courses.jumbotron')
@endsection

@section('content')
<div class="container">
    <div class="pl-5 pr-5">
        <div class="row">
          @include('partials.courses.goals', ['goals' => $course->goals])
        </div>
        <br>
        <div class="row">
          @include('partials.courses.requirements', ['requirements' => $course->requirements])
        </div>
        <br>
        <div class="row">
          @include('partials.courses.description')
        </div>
        <br>
        <div class="row">
          @include('partials.courses.courseContent')
        </div>
        <br>
        <div class="row">
          @include('partials.courses.related')
        </div>
        <div class="row">
          @include('partials.courses.formReviews')
        </div>
        <div class="row">
          @include('partials.courses.reviews')
        </div>
    </div>
</div>
@endsection
