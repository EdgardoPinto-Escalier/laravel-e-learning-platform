<div class="col-12 pt-0">
    <h3 class="text-muted"><i class="far fa-check-square"></i>&nbsp; {{ __("Requirements to take the course") }}</h3>
    <hr />
</div>
@forelse($requirements as $requirement)
    <div class="col-lg-6 col-sm-12">
        <div class="card bg-light p-2">
            <p class="mb-0 text-left">
                <i class="fas fa-check"></i>&nbsp; {{ $requirement->requirement }}
            </p>
        </div>
    </div>
@empty
    <div class="alert alert-dark">
        <i class="fa fa-info-circle"></i>
        {{ __("There are no requirements for this course at this time...") }}
    </div>
@endforelse
