@extends('layouts.app', ['activePage' => 'list-ajuan', 'titlePage' => __('Pengambilan Cuti Pegawai'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Pengambilan Cuti Pegawai') }}</h4>
                <p class="card-category"> {{ __('Berikut adalah data ajuan cuti pegawai Dinas Pemuda, Olahraga dan Pariwisata Kota Balikpapan') }}</p>
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
                  <div class="col-12 text-right">
                    <a href="{{ route('ajuancuti.index') }}" class="btn btn-sm btn-primary">{{ __('Lihat Info Cuti') }}</a>
                    <a href="{{ route('ajuancuti.create') }}" class="btn btn-sm btn-primary">{{ __('Buat Ajuan Cuti') }}</a>
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
                        {{ __('Tahun Cuti') }}
                      </th>
                      <th class="text-center">
                        {{ __('Tahun Sisa Cuti') }}
                      </th>
                      <th class="text-center">
                        {{ __('Tanggal Mulai Cuti') }}
                      </th>
                      <th class="text-center">
                        {{ __('Tanggal Akhir Cuti') }}
                      </th>
                      <th class="text-center">
                        {{ __('Lama Cuti')}}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($notif as $cuti)
                        <tr>
                          <td class="text-center">
                            {{ $cuti->nip }}
                          </td>
                          <td>
                            {{ $cuti->nama }}
                          </td>
                          <td class="text-center">
                            {{ $cuti->tahun_cuti }}
                          </td>
                          <td class="text-center">
                            {{ $cuti->tahun_sisa_cuti }}
                          </td>
                          <td class="text-center">
                            {{ $cuti->tanggal_mulai_cuti }}
                          </td>
                          <td class="text-center">
                            {{ $cuti->tanggal_akhir_cuti }}
                          </td>
                          <td class="text-center">
                            {{ $cuti->lama_cuti }}
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $notif->links() }}
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