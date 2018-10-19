<div class="row mb-4">
    <div class="col-md-12">
        <div class="card" style="background-image: url('{{ url('/images/jumbotron.png') }} ');">
            <div class="text-white text-center py-5 px-4 my-5">
              <div class="row">
                <div class="col-md-5 py-3">
                    <img class="img-fluid imgBorder" src="{{ $course->pathAttachment() }} alt="{{ $course->name }}""/>
                </div>
                <!-- Next we place the details of the course -->
                <div class="col-md-4 text-left py-3">
                    <h3>{{ ("Course") }}: {{ $course->name }}</h3>
                    <h4>{{ ("Teacher") }}: {{ $course->teacher->user->name }}</h4>
                    <h5>{{ ("Category") }}: {{ $course->category->name }}</h5>
                    <h5>{{ ("Published on") }}: {{ $course->created_at->format('d/m/Y') }}</h5>
                    <h5>{{ ("Updated on") }}: {{ $course->updated_at->format('d/m/Y') }}</h5>
                    <h6>{{ ("Students Enrolled") }}: {{ $course->students_count }}</h6>
                    <h6>{{ ("Number of ratings") }}: {{ $course->reviews_count }}</h6>
                    @include('partials.courses.rating', ['rating' => $course->new_rating])
                </div>
                    <!-- Here we include the button file for every action statuses -->
                    @include('partials.courses.action_button')
            </div>
          </div>
        </div>
    </div>
</div>
