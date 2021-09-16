@extends('layouts.app', ['activePage' => 'arsip-mutasi', 'titlePage' => __('Pegawai Mutasi'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Pegawai Mutasi') }}</h4>
                <p class="card-category"> {{ __('Berikut adalah kearsipan data pegawai mutasi Dinas Pemuda, Olahraga dan Pariwisata Kota Balikpapan') }}</p>
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
                        {{ __('Tanggal Resmi Mutasi') }}
                      </th>
                      <th class="text-center">
                        {{ __('Detail') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($index as $mutasi)
                        <tr>
                          <td class="text-center">
                            {{ $mutasi->nip }}
                          </td>
                          <td>
                            {{ $mutasi->nama }}
                          </td>
                          <td class="text-center">
                            {{ $mutasi->tahun_pensiun_mutasi }}
                          </td>
                          <td class="td-actions text-center">
                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('arsipm.detail', ['nip'=> $mutasi->nip]) }}">
                              <p><font color="blue">Detail</font></p>
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