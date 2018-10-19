<div class="col-md-4">
  <div class="card">
      <div class="card-header social">{{ ("LOGIN WITH SOCIAL MEDIA") }}</div>
      <div class="card-body">
          <a
              href="{{ route('social_auth', ['driver' => 'github']) }}"
              class="btn btn-primary btn-lg btn-block"
          >
              {{ ("Github") }}&nbsp; <i class="fab fa-github fa-lg"></i>
          </a>
          <a
                  href="{{ route('social_auth', ['driver' => 'facebook']) }}"
                  class="btn btn-primary btn-lg btn-block"
          >
              {{ ("Facebook") }}&nbsp; <i class="fab fa-facebook fa-lg"></i>
          </a>
      </div>
  </div>
</div>
