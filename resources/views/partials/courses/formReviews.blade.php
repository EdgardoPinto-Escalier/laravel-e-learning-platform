@cannot('enrollToCourse', $course)
    <!-- Here we check if the user can leave a review -->
    @can('review', $course)
        <!-- Here we write the title -->
        <div class="col-12 pt-0 mt-4">
            <h3 class="text-muted">
              <i class="fas fa-pencil-alt"></i>&nbsp; {{ ("How would you rate this course overall?") }}
            </h3>
            <hr />
        </div>
        <!-- Here we place the div holding the stars and the form -->
        <div class="container">
            <form method="POST" action="{{ route('courses.add_review') }}" class="form-inline" id="formRating">
                @csrf
                <div class="form-group">
                    <div class="col-12">
                        <ul id="ratingList" class="list-inline" style="font-size: 30px;">
                            <li class="list-inline-item star" data-number="1"><i class="far fa-star yellow"></i></li>
                            <li class="list-inline-item star" data-number="2"><i class="far fa-star"></i></li>
                            <li class="list-inline-item star" data-number="3"><i class="far fa-star"></i></li>
                            <li class="list-inline-item star" data-number="4"><i class="far fa-star"></i></li>
                            <li class="list-inline-item star" data-number="5"><i class="far fa-star"></i></li>
                        </ul>
                    </div>
                </div>

                <br />
                <!-- Hidden inputs to send the value and course ID -->
                <input type="hidden" name="inputForRatings" value="1" />
                <input type="hidden" name="course_id" value="{{ $course->id }}" />
                <!-- div for the textarea element -->
                <div class="form-group formReview">
                    <div class="col-12">
                        <textarea
                            placeholder="{{ ("Write your review here...") }}"
                            id="message"
                            name="message"
                            class="form-control"
                            rows="8"
                            cols="120"
                        ></textarea>
                    </div>
                </div>
                <!-- Here we place the div holding the botton to review -->
                <div class="row">
                  <div class="col-12 m-3">
                  <button type="submit" class="btn btnReview text-white">
                      <i class="fas fa-pencil-alt fa-lg"></i>&nbsp; {{ ("REVIEW THIS COURSE") }}
                  </button>
                </div>
              </div>
            </form>
        </div>
    @endcan
@endcannot

@push('scripts')
    <script>
        $(document).ready(function() { // Wait till the page is loaded.
            const ratingSelection = $('#ratingList'); // Here we get the UL with all the LI elements inside.
            ratingSelection.find('li').on('click', function() { // Here we look for the LI and when is clicked execute a function.
                const number = $(this).data('number'); // Here we get the number.
                $("#formRating").find('input[name=inputForRatings]').val(number); // Here we access the hidden input and change the value.
                ratingSelection.find('li i').removeClass('yellow').each(function(index) { // Herer we remove the class yellow and place it to the selected element.
                    if ((index + 1) <= number) {  // Here we check if the index 0 + 1 is smaller or equal to the number...
                        $(this).addClass('yellow'); // If that's the case we add the class yellow.
                    }
                })
            })
        });
    </script>
@endpush
