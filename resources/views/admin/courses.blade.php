@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => 'MANAGE COURSES', 'icon' => 'clipboard-list'], ['subtitle' => 'HERE YOU CAN MANAGE ALL THE COURSES IN THE PLATFORM'])
@endsection

@section('content')
    <div class="pl-5 pr-5">
        <!-- Here we create the component courses-list where we will pass the information -->
        <courses-list
            :labels="{{ json_encode([ 
                'name' => ("NAME"),
                'status' => ("STATUS"),
                'activate_deactivate' => ("ENABLE / DISABLE"),
                'approve' => ("APPROVE"),
                'reject' => ("REJECT")
            ]) }}"
            route="{{ route('admin.courses_json') }}"
        >
        </courses-list>
    </div>
@endsection
