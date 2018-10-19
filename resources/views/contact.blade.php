@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center py-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header registerAccount"><i class="fas fa-envelope"></i>&nbsp; {{ __('CONTACT US HERE') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('contact') }}" novalidate>
                         {{ csrf_field() }}

                        <!-- Label for the Name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <!-- Input field for the name -->
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="Enter your name" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Label for email address -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <!-- Input field for the email -->
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Enter your email" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                      <!-- Label for the Message -->
                        <div class="form-group row">
                            <label for="message" class="col-md-4 col-form-label text-md-right">{{ ('Message') }}</label>

                            <!-- Textarea for the Message -->
                            <div class="col-md-6">
                                <textarea id="message" class="form-control{{!! $errors->has('message') ? ' is-invalid' : '' !!}}" name="message" cols="34" rows="8" required></textarea>


                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Button to send the message -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fab fa-telegram-plane"></i>&nbsp; {{ ('SEND') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Here we include the the partial for the contact social media icons -->
        @include('partials.contactSocialMedia')
    </div>
</div>
@endsection
