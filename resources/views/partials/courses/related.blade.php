<div class="col-12 pt-0 mt-5">
    <h3 class="text-muted">
        <i class="fas fa-id-card"></i>&nbsp; {{ ("Similar courses") }}
    </h3>
    <hr />
</div>
<div class="container-fluid">
    <div class="row">
        @forelse($related as $relatedCourse)
            <div class="col-md-6 col-sm-12 listing-block">
                <div class="media">
                    <div class="fav-box">
                        <i class="far fa-heart" aria-hidden="true"></i>
                    </div>
                    <a href="{{ route('courses.detail', $relatedCourse->slug) }}">
                        <img class="img-thumbnail related" style="border: 1px solid #bcbcbc;" src="/images/courses/{{ $relatedCourse->picture }}" alt="{{ $relatedCourse->name }}" />
                    </a>
                    <div class="media-body related pl-3 pt-3">
                        <div class="price">
                            <small>{{ $relatedCourse->name }}</small>
                        </div>
                        <div class="stats">
                            @include('partials.courses.rating', ['rating' => $relatedCourse->new_rating])
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-dark">
                {{ ("There are no related courses...") }}
            </div>
        @endforelse
    </div>
</div>
