@extends('layouts.app', ['activePage' => 'info-pegawai', 'titlePage' => __('Database Kepegawaian'), 'pageName' => __('Databases'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Database Kepegawaian') }}</h4>
                <p class="card-category"> {{ __('Berikut adalah data kepegawaian Dinas Pemuda, Olahraga dan Pariwisata Kota Balikpapan') }}</p>
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
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('pegawai.create') }}" class="btn btn-sm btn-primary">{{ __('Tambah pegawai') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th class="text-center">
                        {{ __('NIP/NIK') }}
                      </th>
                      <th>
                        {{ __('Nama Pegawai') }}
                      </th>
                      <th class="text-center">
                        {{ __('Detail') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($index as $pegawais)
                        <tr>
                          <td class="text-center">
                            {{ $pegawais->nip }}
                          </td>
                          <td>
                            {{ $pegawais->nama }}
                          </td>
                          <td class="td-actions text-center">
                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('pegawai.detail', ['nip'=> $pegawais->nip]) }}">
                              <p><font color="green">Detail</font></p>
                              <div class="ripple-container"></div>
                            </a>
                            <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('arsipm.edit', ['nip'=> $pegawais->nip]) }}">
                              <p><font color="green">Mutasi</font></p>
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