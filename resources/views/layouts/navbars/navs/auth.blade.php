<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="#"><b>{{ $titlePage }}</b></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li>
          Selamat Datang, <b>{{ Auth::user()->nama_user }}</b>
        </li>
        <li class="nav-item dropdown">
        
          <a class="nav-link" href="" id="navbarDropdownKpp" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">notifications</i>
            <span class="notification">{{ $notification->count() }}</span>
            <p class="d-lg-none d-md-block">
              {{ __('Pemberitahuan') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownKpp">
            @foreach($notification as $notif)
              @if($notif->kategori == "kpps")
                <a class="dropdown-item" href="{{ route('kpp.notif') }}">
                  UPDATE KPP : Saatnya {{ $notif->nama }} mengajukan berkas kpp segera!
                </a>
              @endif
              @if($notif->kategori == "kgbs")
                <a class="dropdown-item" href="{{ route('kgb.notif') }}">
                  UPDATE KGB : Saatnya {{ $notif->nama }} mengajukan berkas kgb segera!
                </a>
              @endif
            @endforeach
            @if($notification->count() == 0)
              <a class="dropdown-item" href="#">
                Tidak ada pemberitahuan!
              </a>
            @endif
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">person</i>
            <p class="d-lg-none d-md-block">
              {{ __('Akun') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profil Akun') }}</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Keluar') }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
