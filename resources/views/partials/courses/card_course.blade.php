<div class="card card-01">
    <img class="card-img-top" src="{{ $course->pathAttachment() }}" alt="{{ $course->name }}"/>
    <div class="card-body">
        <span class="badge-box"><i class="fas fa-code"></i></span>
        <h4 class="card-title cardTitle">{{ $course->name }}</h4>
        <hr />
        <div class="row justify-content-center rating">
          @include('partials.courses.rating', ['rating' => $course->new_rating])
        </div>
        <hr />
        <span class="badge badge-danger badge-cat">{{ $course->category->name }}</span>
        <p class="card-text cardText">{{ str_limit($course->description, 90) }}</p>
        <div class="col-lg-12">
            <a href="{{ route('courses.detail', $course->slug) }}" class="btn btnGetMoreInfo btn-block">
                <i class="fas fa-info-circle"></i>&nbsp; {{ ("GET MORE INFORMATION") }}
            </a>
        </div>
    </div>
</div>
