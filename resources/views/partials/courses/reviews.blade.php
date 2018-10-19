<div class="align-content-center">
    <div class="col-12 pt-0 mt-5">
        <h3 class="text-muted">
          <i class="fas fa-users"></i>&nbsp; {{ ("Reviews by Students") }}
        </h3>
        <hr />
    </div>
    <div class="container-fluid">
        <div class="row mb-5">
            <!-- Here we use the forelse directive to get all the reviews -->
            @forelse($course->reviews as $review)
                <div class="col-12 listing-block">
                    <div class="media">
                        <img
                            style="border: 1px solid #bcbcbc; width: auto;"
                            class="img-thumbnail"
                            src="/images/users/default.jpg"
                            alt="{{ $review->user->name }}"
                        />
                        <div class="media-body pl-3 pt-1">
                            @if($review->user->name and $review->comment)
                              <div class="price userName"><small>{{ $review->user->name }} wrote:</small></div>
                              <div class="price"><small>{{ $review->comment }}</small></div>
                            @endif
                            <div class="stats">
                                {{ $review->created_at->format('d/m/Y') }}
                                @include('partials.courses.rating', ['rating' => $review->rating])
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert btn-primary"><i class="fas fa-info-circle fa-lg"></i>&nbsp; {{ ("No ratings yet...") }}</div>
            @endforelse
        </div>
    </div>
</div>
