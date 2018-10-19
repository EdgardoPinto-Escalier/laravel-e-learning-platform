@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center py-2">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header registerAccount"><i class="fas fa-user-circle fa-lg"></i>&nbsp; ABOUT US</div>
            <img class="card-img-top img-fluid p-3 aboutImg" src="/images/about.png" alt="about"/>
            <p class="card-text pt-2 pl-3 pr-3 pb-1">
            <strong>Learn Web Code</strong> is new training and skill development company which was started with a solid vision to bring world class training content, pedagogy and best learning practices to everyone's doorsteps. Learn Web Code aims to identify and provide the best learning and training environment for the student.</p>  
            
            <p class="card-text pl-3 pr-3 pb-3">It identifies industry veterans and content creators around the globe and bring it to the global audience using number of intuitive platforms for easy and affordable access to quality content. <strong>Learn Web Code</strong> offers easy to understand web development online courses for everyone. If you have ever wanted to learn a new skill, but don't want to attend four years of college to do it, we have a solution for you.</p>
            </div>
        </div>
        <!-- Here we include the the partial for the contact social media icons -->
        @include('partials.contactSocialMedia')
    </div>
</div>
@endsection
