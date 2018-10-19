<div class="col-12 pt-0 mt-0">
    <h3 class="text-muted"><i class="fas fa-clipboard-list"></i>&nbsp; {{ __("Goals of this course") }}</h3>
    <hr />
</div>
@forelse($goals as $goal)
    <div class="col-lg-6 col-sm-12">
        <div class="card bg-light p-2">
            <p class="mb-0 text-left">
                <i class="fas fa-check">&nbsp; </i>{{ $goal->goal }}
            </p>
        </div>
    </div>
@empty
    <div class="alert alert-dark">
        <i class="fa fa-info-circle"></i>
        {{ __("No goals have been written for this course") }}
    </div>
@endforelse
