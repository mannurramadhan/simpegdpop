@extends('layouts.app', ['activePage' => 'info-gaji', 'titlePage' => __('Informasi Gaji Pegawai'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Informasi Gaji Pegawai') }}</h4>
                <p class="card-category"> {{ __('Berikut adalah data pegawai negeri sipil (PNS) Dinas Pemuda, Olahraga dan Pariwisata Kota Balikpapan') }}</p>
              </div>
              <div class="card-body">
              @if (session('success'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <span>{{ session('success') }}</span>
                      </div>
                    </div>
                  </div>
                @elseif (session('failed'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-danger">
                        <span>{{ session('failed') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th class="text-center">
                          {{ __('NIP') }}
                      </th>
                      <th>
                        {{ __('Nama Pegawai') }}
                      </th>
                      <th class="text-center">
                        {{ __('MKG') }}
                      </th>
                      <th class="text-center">
                        {{ __('Golongan') }}
                      </th>
                      <th class="text-center">
                        {{ __('Gaji Saat Ini') }}
                      </th>
                      <th class="text-center">
                        {{ __('Detail') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($index as $kgb)
                        <tr>
                          <td class="text-center">
                            {{ $kgb->nip }}
                          </td>
                          <td>
                            {{ $kgb->nama }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->mkg }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->golongan }}
                          </td>
                          <td class="text-center">
                            {{ $kgb->gaji_pegawai }}
                          </td>
                          <td class="text-center">
                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('kgb.detail', ['nip'=> $kgb->nip]) }}">
                              <p><font color="green">Detail</font></p>
                              <div class="ripple-container"></div>
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $index->links() }}
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
      });
    }, 5000);
  </script>
@endsection