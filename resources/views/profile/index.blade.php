@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => 'PROFILE SETTINGS', 'icon' => 'wrench'], ['subtitle' => 'HERE YOU CAN UPDATE YOUR PERSONAL INFORMATION (CHANGE PASSWORD AND BECOME A TEACHER IN THE PLATFORM)'])
@endsection

@push('styles')
  <!-- Responsive for DataTables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css"/>
@endpush

@section('content')
    <div class="pl-5 pr-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header profile">
                        <i class="fas fa-clipboard-check"></i>&nbsp; {{ ("UPDATE YOUR DETAILS") }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}" novalidate >
                            <!-- First we use the directive csrf -->
                            {{ csrf_field() }}
                            <!-- And here we use the directive PUT to let the form know and use the PUT method -->
                            @method('PUT')
                            <!-- Label for email -->
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    {{ ("EMAIL") }} &nbsp;<i class="fas fa-envelope"></i>
                                </label>
                                <div class="col-md-6">
                                    <!-- Input for email with $errors variable from laravel in case of any errors-->
                                    <input
                                        id="email"
                                        type="email"
                                        readonly
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email"
                                        value="{{ old('email') ?: $user->email }}"
                                        required
                                        autofocus
                                    />
                                    <!-- If there are errors with the email show the first error only -->
                                    @if($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <!-- Label for password -->
                                <label
                                    for="password"
                                    class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ ("PASSWORD") }} &nbsp;<i class="fas fa-key"></i>
                                </label>

                                <div class="col-md-6">
                                    <!-- Input for password with $errors variable from laravel in case of any errors -->
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password"
                                        required
                                    />
                                    <!-- If there are errors with the password show the first error only -->
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <!-- Label for password confirm -->
                                <label
                                    for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ ("REPEAT PASSWORD") }} &nbsp;<i class="fas fa-key"></i>
                                </label>
                                <!-- Input for password confirm -->
                                <div class="col-md-6">
                                    <input
                                        id="password-confirm"
                                        type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                        required
                                    />
                                </div>
                            </div>
                            <!-- div for the button update your details -->
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4 col-sm-12">
                                    <button type="submit" class="btn updateProfile">
                                        <i class="fas fa-sync"></i>&nbsp; {{ ("UPDATE YOUR DETAILS") }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Here we make a small check to see if the user is teacher or not -->
                @if( ! $user->teacher)
                    <!-- If the user is not a teacher on the platform show this card -->
                    <div class="card">
                        <div class="card-header becomeTeacher">
                            <i class="fas fa-graduation-cap"></i>&nbsp; {{ ("BECOME A TEACHER ON THIS PLATFORM") }}
                        </div>
                        <div class="card-body text-center">
                            <form action="{{ route('solicitude.teacher') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="col-sm-12">
                                  <button type="submit" class="btn btnApplyForTeacher">
                                      <i class="fas fa-clipboard-check"></i>&nbsp; {{ ("APPLY TO BE A TEACHER NOW") }}
                                  </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else <!-- Otherwise, if the user is already a teacher show the following card -->
                    <div class="card">
                        <div class="card-header manageCourses">
                            <i class="fas fa-graduation-cap"></i>&nbsp; {{ ("MANAGE THE COURSES I TEACH") }}
                        </div>
                        <div class="card-body text-center">
                            <a href="{{ route('teacher.courses') }}" class="btn btnManage">
                                <i class="fas fa-folder-open"></i>&nbsp; {{ ("MANAGE MY COURSES NOW") }}
                            </a>
                        </div>
                    </div>
                    <!-- Next we create the card that will hold the table with the students -->
                    <div class="card">
                        <div class="card-header myStudents">
                            <i class="fas fa-users"></i>&nbsp; {{ ("MY STUDENTS") }}
                        </div>
                        <div class="card-body">
                          <!-- Table where we will show the teacher's students using DataTables -->
                          <table class="table dataTable table-striped table-bordered nowrap" cellspacing="0" id="teacherStudentsTable">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-id-card-alt"></i>&nbsp; {{ ("ID") }}</th>
                                        <th><i class="far fa-user-circle"></i>&nbsp; {{ ("Name") }}</th>
                                        <th><i class="far fa-envelope"></i>&nbsp; {{ ("Email") }}</th>
                                        <th><i class="fas fa-graduation-cap"></i>&nbsp; {{ ("Courses") }}</th>
                                        <th><i class="fas fa-bolt"></i>&nbsp; {{ ("Contact") }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- Here we make a small check to see if the user did access using social media -->
                @if($user->socialAccount)
                    <!-- If that's the case we create a new card -->
                    <div class="card">
                        <div class="card-header socialAccess">
                            <i class="fas fa-sign-in-alt"></i>&nbsp; {{ ("SOCIAL MEDIA ACCESS") }}
                        </div>
                        <div class="card-body text-center">
                            <!-- And here we will create a button that will show the current social media
                            account used to access to the platform -->
                            <button class="btn btnSocialAccess">
                                {{ ("REGISTERED WITH") }}:&nbsp;  <i class="fab fa-{{ $user->socialAccount->provider }}"></i>
                                {{ $user->socialAccount->provider }}
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Here we include the modal window -->
    @include('partials.modal')
@endsection

<!-- Here we use the push directive -->
@push('scripts')
    <!-- Here we add responsive datatables -->
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <!-- Here we add datatables for bootstrap -->
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
    <script>
        // First we define some variables.
        let myDataTable;
        let modalWindow = $("#appModal");
        // Next when the page is ready execute the following code:
        $(document).ready(function() {
            // Here we convert a simple html table into a DataTable
            // Inside will accep an object with the table settings as follows:
            myDataTable = $("#teacherStudentsTable").DataTable({
                responsive: true, // Make it responsive
                pageLength: 5, // How many elements per page
                lengthMenu: [ 5, 10, 25, 50, 75, 100 ], // Menu length
                processing: true, // Show message when processing
                serverSide: true, // Will make the petitions on the server
                // Next, using ajax we'll write the route we want to show.
                ajax: '{{ route('teacher.students') }}',
                // Next we define the columns using an array.
                columns: [
                    // Here we use data: to take the information from
                    {data: 'user.id', visible: false},
                    {data: 'user.name'},
                    {data: 'user.email'},
                    {data: 'courses_formatted'},
                    {data: 'actions'}
                ]
            });

            // Next we use the onClick event with the button inside the modal window.
            $(document).on("click", '.btnSendEmail', function (e) {
                // When we click on the button we prevent default behavior of empty link.
                e.preventDefault();
                // Next we get to the user id.
                const id = $(this).data('id');
                // Next we access to the variable modalWindow to look for the class .modal-title
                // so we can insert dynamically the title using .text() and blade.
                modalWindow.find('.modal-title').text('{{ ("SEND MESSAGE TO THIS STUDENT") }}');
                // Next we do the same but this time with the button to send message
                modalWindow.find('#modalAction').text('{{ ("SEND MESSAGE") }}').show();
                // Next we define the variable $bodyMessage and we assign to it a form
                let $bodyMessage = $("<form id='studentMessage'></form>");
                // We use the form to insert information dynamically (input and text area elements)
                $bodyMessage.append(`<input type="hidden" name="user_id" value="${id}" />`);
                $bodyMessage.append(`<textarea class="form-control" name="message"></textarea>`);
                // Next we find the class .modal-body and insert the form dynamically.
                modalWindow.find('.modal-body').html($bodyMessage);
                // Finally we call the modal window to open.
                modalWindow.modal();
            });

            // Next here we send a message (Teacher to Student) using ajax.
            $(document).on("click", "#modalAction", function (e) {
                // When we click on the button with id #modalAction we Will
                // make a petition using ajax. with an object.
                $.ajax({
                    // Here the petition will be loaded into one of the routes of the application.
                    url: '{{ route('teacher.send_message_to_student') }}',
                    type: 'POST', // The petition will be of POST type.
                    headers: {
                        // Here we send the header with the csrf token (this token can be found on app.blade.php)
                        'x-csrf-token': $("meta[name=csrf-token]").attr('content')
                    },
                    // Next we define the data property
                    data: {
                        // This is the info that will be sent: The form and will be serialized so we can
                        // use it in the route we have defined above (route('teacher.send_message_to_student')
                        info: $("#studentMessage").serialize()
                    },
                    // Success with a response
                    success: (res) => {
                        // If success we will hide the action button
                        if(res.res) {
                            modalWindow.find('#modalAction').hide();
                            // and we show a success message.
                            modalWindow.find('.modal-body').html('<div class="alert alert-success">{{ ("The message has been sent successfully!") }}</div>');
                        } else { // Otherwise...
                            // We show an error message.
                            modalWindow.find('.modal-body').html('<div class="alert alert-danger">{{ ("An error has occurred sending your message...") }}</div>');
                        }
                    }
                })
            })
        })
    </script>
@endpush
