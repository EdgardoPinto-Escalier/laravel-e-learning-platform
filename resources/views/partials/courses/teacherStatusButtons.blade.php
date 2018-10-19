<div class="col-md-10 ml-0 mb-3">
  <div class="row">
    <!-- If the course status is published we show the info button -->
    @if((int) $course->status === \App\Course::PUBLISHED)
        <a class="btn btn-primary btnInfoCoursee" href="{{ route('courses.detail', ["slug" => $course->slug]) }}">
            <i class="fas fa-info-circle"></i>&nbsp; {{ ("INFO") }}
        </a>
        <!-- and the edit button -->
        <a class="btn btn-primary btnEditCoursee text-white" href="{{ route('courses.edit', ["slug" => $course->slug]) }}">
            <i class="far fa-edit"></i>&nbsp; {{ ("EDIT") }}
        </a>
        <!-- we also include the delete button -->
        @include('partials.courses.buttonForms.delete')
    <!-- If the course status is pending we show the pending button -->
    @elseif((int) $course->status === \App\Course::PENDING)
        <a class="btn btnPendingCourse text-white" href="#">
            <i class="far fa-clock"></i>&nbsp; {{ ("PENDING") }}
        </a>
        <!-- We also show the info button -->
        <a class="btn btnInfoCourse" href="{{ route('courses.detail', ["slug" => $course->slug]) }}">
            <i class="fas fa-info-circle"></i>&nbsp; {{ ("INFO") }}
        </a>
        <!-- The edit button -->
        <a class="btn btnEditCourse text-white" href="{{ route('courses.edit', ["slug" => $course->slug]) }}">
            <i class="far fa-edit"></i>&nbsp; {{ ("EDIT") }}
        </a>
        <!-- and the delete button -->
        @include('partials.courses.buttonForms.delete')
    @else
        <!-- Otherwise if the course has been rejected, we show the course rejected and delete buttons -->
        <a class="btn btnRejected text-white" href="#">
            <i class="fas fa-pause"></i>&nbsp; {{ ("COURSE REJECTED") }}
        </a>
        @include('partials.courses.buttonForms.delete')
    @endif
  </div>
</div>
