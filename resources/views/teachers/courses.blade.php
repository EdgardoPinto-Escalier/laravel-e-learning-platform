<!-- First we extend from layouts.app -->
@extends('layouts.app')
<!-- Next we include the jumbotron -->
@section('jumbotron')
    @include('partials.jumbotron', ['title' => 'COURSES CREATED AND TEACHED BY ME', 'icon' => 'graduation-cap'], ['subtitle' => 'HERE YOU CAN FIND THE LIST OF CURRENT COURSES CREATED BY YOU'])
@endsection
<!-- Next we add the content section -->
@section('content')
<div class="container">
  <div class="card-1">
    <!-- Here we do a forelse to loop through the courses -->
    @forelse($courses as $course)
    <div class="row mb-5">
      <div class="col-md-6 col-sm-4 col-xs-3">
          <img class="img-responsive imgBorderTeacher" src="{{ $course->pathAttachment() }}" alt="{{ $course->name }}" />
        </div>
        <div class="col-md-6 media-body" style="height: auto; border: 1px solid #ccc;">
          <div class="card-block">
            <h4 class="card-title ml-0 pt-2 pb-2 badge-danger text-white text-center price">{{ $course->category->name }}</h4>
            <p class="card-text">{{ ("Course") }}: {{ $course->name }}</p>
            <p class="card-text">{{ ("Students") }}: {{ $course->students_count }}</p>
            <div class="stats">
                {{ $course->created_at->format('d/m/Y') }}
                @include('partials.courses.rating', ['rating' => $course->custom_rating])
            </div>
            @include('partials.courses.teacherStatusButtons')
          </div>
        </div>
      </div>
      @empty
      <div class="alert alert-dark py-3 justify-content-center">
        <div class="row py-1 justify-content-center">
          <i class="fas fa-exclamation-triangle fa-lg"></i>&nbsp; {{ ("YOU HAVE NOT CREATED ANY COURSES YET!") }}
        </div>
        <div class="row py-1 justify-content-center">
          <a class="btn btn-course btnCreateCourse" href="{{ route('courses.create') }}">
              <i class="fas fa-edit"></i>&nbsp; {{ ("CREATE YOUR FIRST COURSE NOW") }}
          </a>
        </div>
      </div>
      @endforelse
    </div>

  </div>
</div>
@endsection
