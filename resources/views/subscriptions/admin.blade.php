@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => ' MY SUBSCRIPTIONS', 'icon' => 'bullhorn'], ['subtitle' => ' HERE YOU CAN SEE THE LIST OF CURRENT SUBSCRIPTIONS'])
@endsection

@section('content')
    <div class="pl-5 pr-5">
        <div class="row justify-content-around">
            <table class="table table-hover table-active table-bordered table-responsive-lg">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><i class="fas fa-bullhorn fa-lg"></i>&nbsp; NAME</th>
                        <th scope="col"><i class="fas fa-globe fa-lg"></i>&nbsp; PLAN TYPE</th>
                        <th scope="col"><i class="fas fa-id-card fa-lg"></i>&nbsp; SUBSCRIPTION ID</th>
                        <th scope="col"><i class="fas fa-list-ol fa-lg"></i>&nbsp; QUANTITY</th>
                        <th scope="col"><i class="fas fa-hourglass-start fa-lg"></i>&nbsp; STARTED</th>
                        <th scope="col"><i class="fas fa-hourglass-end fa-lg"></i>&nbsp; ENDS</th>
                        <th scope="col"><i class="fas fa-hand-paper fa-lg"></i>&nbsp; CANCEL / RESUME</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscriptions as $subscription)
                        <td>{{ $subscription->id }}</td>
                        <td>{{ $subscription->name }}</td>
                        <td>{{ $subscription->stripe_plan }}</td>
                        <td>{{ $subscription->stripe_id }}</td>
                        <td>{{ $subscription->quantity }}</td>
                        <td>{{ $subscription->created_at->format('d/m/Y') }}</td>
                        <td>{{ $subscription->ends_at ? $subscription->ends_at->format('d/m/Y') : __("Active subscription") }}</td>
                        <td>
                            @if($subscription->ends_at)
                                <form action="{{ route('subscriptions.resume') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="plan" value="{{ $subscription->name }}" />
                                    <button class="btn btn-success">
                                        <i class="fas fa-undo-alt"></i>&nbsp; {{ __("Resume") }}
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('subscriptions.cancel') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="plan" value="{{ $subscription->name }}" />
                                    <button class="btn btn-danger">
                                        <i class="fas fa-times"></i>&nbsp; {{ __("Cancel") }}
                                    </button>
                                </form>
                            @endif
                        </td>
                    @empty
                        <tr>
                            <td colspan="8">{{ __("There are no subscriptions available at this moment...") }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
