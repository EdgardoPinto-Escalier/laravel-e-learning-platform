<li class=""><a class="nav-link" href="{{ url('/home') }}"><i class="fas fa-clipboard-list"></i>&nbsp; {{ ("COURSE LIST") }}</a></li>

<li class="nav-item dropdown">
  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-external-link-alt"></i>&nbsp; MY STUDENT ACCESS LINKS
  </a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="{{ route('profile.index') }}"><i class="fas fa-user-circle fa-lg"></i>&nbsp; {{ ("MY PROFILE") }}</a>
    <a class="dropdown-item" href="{{ route('subscriptions.admin') }}"><i class="fas fa-edit fa-lg"></i>&nbsp; {{ ("MY SUBSCRIPTIONS") }}</a>
    <a class="dropdown-item" href="{{ route('invoices.admin') }}"><i class="fa fa-clone fa-lg" aria-hidden="true"></i>&nbsp; {{ ("MY INVOICES") }}</a>
    <a class="dropdown-item" href="{{ route('courses.subscribed') }}"><i class="fas fa-graduation-cap fa-lg"></i>&nbsp; {{ ("MY COURSES") }}</a>
  </div>
</li>
@include('partials.navigations.logged')
