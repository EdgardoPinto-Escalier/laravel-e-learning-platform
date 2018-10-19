<div class="col-md-2">
    @auth
        @can('opt_for_course', $course)
             @can('subscribe', \App\Course::class)
                <a class="btn btn-subscribe btn-bottom btn-block" href="{{ route('subscriptions.plans') }}">
                    <i class="fas fa-sign-in-alt fa-lg"></i>&nbsp; {{ ("Get Premium") }}
                </a>
             @else
                 @can('enrollToCourse', $course)
                    <a class="btn btn-subscribe btn-bottom btn-block" href="{{ route('courses.enrollToCourse', ['slug' => $course->slug]) }}">
                        <i class="far fa-edit"></i>&nbsp; {{ ("Enroll") }}
                    </a>
                 @else
                    <a class="btn btn-subscribe btn-bottom btn-block" href="#">
                        <i class="far fa-check-square"></i>&nbsp; {{ ("Enrolled") }}
                    </a>
                 @endcan
             @endcan
        @else
            <a class="btn btn-subscribe btn-bottom btn-block" href="#">
                <i class="fas fa-user-plus"></i>&nbsp; {{ ("Author") }}
            </a>
        @endcan
    @else
        <a class="btn btn-subscribe btn-bottom btn-block" href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt"></i>&nbsp; {{ ("Login") }}
        </a>
    @endauth
</div>
