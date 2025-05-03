<nav class="navbar navbar-light bg-light shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="{{url("/")}}">MyShop</a>
      <ul class="navbar-nav flex-row">
        <li class="nav-item me-3">
          <a class="nav-link" href="{{route("cart")}}">Cart


              <span class="badge bg-danger" id="cart-count"></span>

          </a>
        </li>
        <li class="nav-item">
          @if(session()->has('USER_LOGIN'))
          <p>{{session("USER_NAME")}}</p>
            <a href="{{url("/logout")}}" class="btn btn-outline-danger btn-sm">Logout</a>
          @else
            <a href="{{route('front.login')}}" class="btn btn-outline-primary btn-sm">Login</a>
          @endif
        </li>
      </ul>
    </div>
  </nav>
