<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{ route('home') }}" class="simple-text logo-normal">
    <img style="width:50px" src="{{ asset('material') }}/img/logo-pemkot.png"><br>
      {{ __('SIMPEG DPOP') }}<br>{{ __('KOTA BALIKPAPAN') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Beranda') }}</p>
        </a>
      </li>

      <!-- Fitur 1 -->
      <li class="nav-item {{ ($activePage == 'cuti-pegawai' || $activePage == 'ajuan-cuti' || $activePage == 'list-ajuan') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#cutiPegawai" aria-expanded="true">
          <i class="material-icons">home_work</i>
          <p>{{ __('Cuti Pegawai') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="cutiPegawai">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'cuti-pegawai' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('ajuancuti.index') }}">
                <span class="sidebar-mini"> ICP </span>
                <span class="sidebar-normal">{{ __('Informasi Cuti Pegawai') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'ajuan-cuti' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('ajuancuti.create') }}">
                <span class="sidebar-mini"> FCP </span>
                <span class="sidebar-normal"> {{ __('Form Cuti Pegawai') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'list-ajuan' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('ajuancuti.notif') }}">
                <span class="sidebar-mini"> PCP </span>
                <span class="sidebar-normal"> {{ __('Pengambilan Cuti Pegawai') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Fitur 2 -->
      <li class="nav-item {{ ($activePage == 'info-gaji' || $activePage == 'notif-kgb') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#kgb" aria-expanded="true">
          <i class="material-icons">attach_money</i>
          <p>{{ __('Kenaikan Gaji Berkala') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="kgb">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'info-gaji' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('kgb.index') }}">
                <span class="sidebar-mini"> IGP </span>
                <span class="sidebar-normal">{{ __('Informasi Gaji Pegawai') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'notif-kgb' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('kgb.notif') }}">
                <span class="sidebar-mini"> PKGB </span>
                <span class="sidebar-normal"> {{ __('Pemberitahuan KGB') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Fitur 3 -->
      <li class="nav-item {{ ($activePage == 'info-kpp' || $activePage == 'notif-kpp') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#kpp" aria-expanded="true">
          <i class="material-icons">people_alt</i>
          <p>{{ __('Kenaikan Pangkat') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="kpp">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'info-kpp' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('kpp.index') }}">
                <span class="sidebar-mini"> IPP </span>
                <span class="sidebar-normal">{{ __('Informasi Pangkat Pegawai') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'notif-kpp' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('kpp.notif') }}">
                <span class="sidebar-mini"> PKP </span>
                <span class="sidebar-normal"> {{ __('Pemberitahuan Naik Pangkat') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Fitur 4 -->
      <li class="nav-item {{ ($activePage == 'info-pensiun' || $activePage == 'notif-pensiun') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#pensiunPegawai" aria-expanded="true">
          <i class="material-icons">access_alarm</i>
          <p>{{ __('Waktu Pesiun') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="pensiunPegawai">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'info-pensiun' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('pensiun.index') }}">
                <span class="sidebar-mini"> IPP </span>
                <span class="sidebar-normal">{{ __('Info Pensiun Pegawai') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'notif-pensiun' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('pensiun.notif') }}">
                <span class="sidebar-mini"> PP </span>
                <span class="sidebar-normal"> {{ __('Pemberitahuan Pensiun') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Fitur 5 -->
      <li class="nav-item {{ ($activePage == 'info-pegawai' || $activePage == 'input-pegawai') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#databasePegawai" aria-expanded="true">
          <i class="material-icons">folder_shared</i>
          <p>{{ __('Database Pegawai') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="databasePegawai">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'info-pegawai' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('pegawai.index') }}">
                <span class="sidebar-mini"> IP </span>
                <span class="sidebar-normal">{{ __('Informasi Pegawai') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'input-pegawai' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('pegawai.create') }}">
                <span class="sidebar-mini"> IDP </span>
                <span class="sidebar-normal"> {{ __('Input Data Pegawai') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Fitur 6 -->
      <li class="nav-item {{ ($activePage == 'arsip-pensiun' || $activePage == 'arsip-mutasi') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#kearsipanData" aria-expanded="true">
          <i class="material-icons">archive</i>
          <p>{{ __('Kearsipan Data') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="kearsipanData">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'arsip-pensiun' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('arsipp.index') }}">
                <span class="sidebar-mini"> PP </span>
                <span class="sidebar-normal">{{ __('Pegawai Pensiun') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'arsip-mutasi' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('arsipm.index') }}">
                <span class="sidebar-mini"> PM </span>
                <span class="sidebar-normal"> {{ __('Pegawai Mutasi') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      
      <!-- Fitur User Management-->
      <!--<li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#userSetting" aria-expanded="true">
          <i class="material-icons">person_add</i>
          <p>{{ __('Manajemen Pengguna') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="userSetting">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('Profil Pengguna') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>-->
    </ul>
  </div>
</div>