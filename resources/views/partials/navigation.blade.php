<header>
    <nav class="navbar navbar-expand-lg navbar-laravel">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-code"></i>&nbsp; {{ config('app.name') }}
        </a>

        <button class="navbar-dark navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                @include('partials.navigations.' . \App\User::navigation())
            </ul>
        </div>
    </nav>
</header>
