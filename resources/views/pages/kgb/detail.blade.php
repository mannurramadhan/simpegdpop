@extends('layouts.app', ['activePage' => 'info-gaji', 'titlePage' => __('Riwayat Kenaikan Gaji Berkala'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Riwayat Kenaikan Gaji Berkala') }}</h4>
                <p class="card-category"> {{ __('Berikut adalah data riwayat kenaikan gaji berkala pegawai Dinas Pemuda, Olahraga dan Pariwisata Kota Balikpapan') }}</p>
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
                        {{ __('Gaji Lama/Baru') }}
                      </th>
                      <th class="text-center">
                        {{ __('Pejabat Lama/Baru') }}
                      </th>
                      <th class="text-center">
                        {{ __('Nomor SK Lama/Baru') }}
                      </th>
                      <th class="text-center">
                        {{ __('Tanggal SK Lama/Baru') }}
                      </th>
                      <th class="text-center">
                        {{ __('MKG Lama/Baru') }}
                      </th>
                      <th class="text-center">
                        {{ __('TMT Lama/Baru') }}
                      </th>
                      <th class="text-center">
                        {{ __('Tanggal KGB Baru') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($detail as $kgb)
                        <tr>
                          <td class="text-center">
                            {{ $kgb->nip }}
                          </td>
                          <td>
                            {{ $kgb->nama }}
                          </td>
                          <td class="text-center">
                            ({{ $kgb->gaji_lama }}) / ({{ $kgb->gaji_baru }})
                          </td>
                          <td class="text-center">
                            ({{ $kgb->pejabat_lama }}) / ({{ $kgb->pejabat_baru }})
                          </td>
                          <td class="text-center">
                            ({{ $kgb->no_sk_lama }}) / ({{ $kgb->no_sk_baru }})
                          </td>
                          <td class="text-center">
                            ({{ $kgb->tanggal_sk_lama }}) / ({{ $kgb->tanggal_sk_baru }})
                          </td>
                          <td class="text-center">
                            ({{ $kgb->mkg_lama }}) / ({{ $kgb->mkg_baru }})
                          </td>
                          <td class="text-center">
                            ({{ $kgb->tmt_lama }}) / ({{ $kgb->tmt_baru }})
                          </td>
                          <td class="text-center">
                            ({{ $kgb->tanggal_kgb_baru }})
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                  <a class="btn btn-primary" href="{{ route('kgb.index') }}">{{ __('Kembali') }}</a>
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