@extends('layouts.app', ['activePage' => 'cuti-pegawai', 'titlePage' => __('Informasi Cuti Pegawai'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Informasi Cuti Pegawai') }}</h4>
                <p class="card-category"> {{ __('Berikut adalah data cuti tahunan pegawai negeri sipil (PNS) Dinas Pemuda, Olahraga dan Pariwisata Kota Balikpapan') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-md-12 text-right">
                    <a href="{{ route('ajuancuti.create') }}" class="btn btn-sm btn-primary">{{ __('Buat Ajuan Cuti') }}</a>
                    <a href="{{ route('ajuancuti.notif') }}" class="btn btn-sm btn-primary">{{ __('Lihat List Ajuan') }}</a>
                  </div>
                </div>
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
                        {{ __('Sisa Cuti Tahunan (N)') }}
                      </th>
                      <th class="text-center">
                        {{ __('Sisa Cuti Tahunan (N-1)') }}
                      </th>
                      <th class="text-center">
                        {{ __('Sisa Cuti Tahunan (N-2)') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($index as $cuti)
                        <tr>
                          <td class="text-center">
                            {{ $cuti->nip }}
                          </td>
                          <td>
                            {{ $cuti->nama }}
                          </td>
                          <td class="text-center">
                            {{ $cuti->sisa_tahun_n }}
                          </td>
                          <td class="text-center">
                            {{ $cuti->sisa_tahun_n1 }}
                          </td>
                          <td class="text-center">
                            {{ $cuti->sisa_tahun_n2 }}
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