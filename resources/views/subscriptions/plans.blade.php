@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">
@endpush

@section('jumbotron')
    @include('partials.jumbotron', ['title' => ("UPGRADE TO ONE OF OUR PREMIUM PLANS"),'icon' => 'chart-line'], ['subtitle' => ("HERE YOU CAN CHOOSE BETWEEN OUT DIFFERENT PLANS")])
@endsection

@section('content')
    <!-- Monthly plan pricing table starts here -->
    <div class="container">
        <div class="row pricing-table pricing-three-column">
            <div class="plan col-sm-6 col-lg-6">
              <div class="marginBetween">
                <div class="monthlyPlan">
                    <h2><i class="far fa-calendar-alt"></i>&nbsp; {{ ("MONTHLY") }}</h2>
                    <h5><strong>{{ ("USD " .":price / Month : $ 9.00") }}</strong></h5>
                    <p>billed monthly</p>
                </div>
                <ul>
                    <li class="plan-feature"><i class="fas fa-check fa-lg"></i>&nbsp; {{ ("Unlimited access to all content") }}</li>
                    <li class="plan-feature"><i class="fas fa-check fa-lg"></i>&nbsp; {{ ("Stream premium videos") }}</li>
                    <li class="plan-feature"><i class="fas fa-check fa-lg"></i>&nbsp; {{ ("Download videos to watch offline") }}</li>
                    <li class="plan-feature"><i class="fas fa-check fa-lg"></i>&nbsp; {{ ("Get the full source code") }}</li>
                    <li class="plan-feature"><i class="fas fa-check fa-lg"></i>&nbsp; {{ ("Cancel at any time — no questions asked") }}</li>
                    <li class="plan-feature button">
                        @include('partials.stripe.form', [
                            "product" => [
                                "name" => ("PLAN TYPE"),
                                "description" => ("MONTHLY"),
                                "type" => "Monthly",
                                "amount" => 900.00
                            ]
                        ])
                    </li>
                </ul>
            </div>
          </div>


            <!-- Yearly plan pricing table starts here -->
            <div class="plan col-sm-6 col-lg-6">
              <div class="marginBetween">
                <div class="yearlyPlan">
                    <h2><i class="far fa-calendar-alt"></i>&nbsp; {{ ("YEARLY") }}</h2>
                    <h5><strong>{{ ("USD " .":price / Year : $ 90.00") }}</strong></h5>
                    <p>save 20% billed yearly</p>
                </div>
                <ul>
                    <li class="plan-feature"><i class="fas fa-check fa-lg"></i>&nbsp; {{ ("+ Two months discount!") }}</li>
                    <li class="plan-feature"><i class="fas fa-check fa-lg"></i>&nbsp; {{ ("Unlimited access to all content") }}</li>
                    <li class="plan-feature"><i class="fas fa-check fa-lg"></i>&nbsp; {{ ("Stream premium videos") }}</li>
                    <li class="plan-feature"><i class="fas fa-check fa-lg"></i>&nbsp; {{ ("Download videos to watch offline") }}</li>
                    <li class="plan-feature"><i class="fas fa-check fa-lg"></i>&nbsp; {{ ("Get the full source code") }}</li>
                    <li class="plan-feature"><i class="fas fa-check fa-lg"></i>&nbsp; {{ ("One year of access to all our content") }}</li>
                    <li class="plan-feature button">
                        <!-- Next we include the stripe form with an array -->
                        @include('partials.stripe.form',
                            ["product" => [
                                'name' => 'PLAN TYPE',
                                'description' => 'YEARLY',
                                'type' => 'Yearly',
                                'amount' => 9000.00
                            ]]
                        )
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
