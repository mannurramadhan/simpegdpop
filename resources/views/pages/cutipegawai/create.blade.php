@extends('layouts.app', ['activePage' => 'ajuan-cuti', 'titlePage' => __('Form Cuti Pegawai'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('ajuancuti.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Form Cuti Pegawai') }}</h4>
                <p class="card-category">Silahkan isi form cuti pegawai berikut dengan benar!</p>
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
                <div class="row">
                  <div class="col-md-12 text-right">
                    <a href="{{ route('ajuancuti.index') }}" class="btn btn-sm btn-primary">{{ __('Lihat Info Cuti') }}</a>
                    <a href="{{ route('ajuancuti.notif') }}" class="btn btn-sm btn-primary">{{ __('Lihat List Ajuan') }}</a>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-8">
                    <label for="nip">NAMA / NIP</label>
                    <select class="form-control" data-style="btn btn-link" id="nip" name="nip" required>
                      <optgroup label="NIP/NIK">
                        <option value="">Pilih nama pegawai :</option>
                        @foreach($create as $cuti)
                        <option value="{{ $cuti->nip }}">{{ $cuti->nama }} / {{ $cuti->nip }}</option>
                        @endforeach
                      </optgroup>
                    </select>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-8">
                    <label for="nama">NAMA LENGKAP</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-4">
                    <label for="tahun_sisa_cuti">TAHUN SISA CUTI</label>
                    <select class="form-control" onchange="ambiltahun()" data-style="btn btn-link" id="tahun_sisa_cuti" name="tahun_sisa_cuti" required>
                    <?php
                      $n = date('Y');
                      $n1 = date('Y', strtotime('-1 year', strtotime($n)));
                      $n2 = date('Y', strtotime('-2 year', strtotime($n)));
                    ?>
                      <option value="">Tahun Sisa Cuti (N/N-1/N-2):</option>
                      <option value="<?php echo $n;?>">N</option>
                      <option value="<?php echo $n1;?>">N-1</option>
                      <option value="<?php echo $n2;?>">N-2</option>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <label for="tahuncuti">TAHUN CUTI</label>
                    <input type="text" class="form-control" id="tahun_cuti" name="tahun_cuti" placeholder="Tahun Cuti" required>
                    <input type="text" id="sisa_cuti" name="sisa_cuti" hidden>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-4">
                    <label for="tanggal_mulai_cuti">TAHUN MULAI CUTI</label>
                    <input type="date" class="form-control" id="tanggal_mulai_cuti" name="tanggal_mulai_cuti" placeholder="Tahun Mulai Cuti" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="tanggal_akhir_cuti">TAHUN AKHIR CUTI</label>
                    <input type="date" class="form-control" id="tanggal_akhir_cuti" name="tanggal_akhir_cuti" placeholder="Tahun Akhir Cuti" required>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Tambah Ajuan') }}</button>
              </div>
            </div>
          </form>
          <script type="text/javascript">
            function ambiltahun(){

            // ambil nilai
            var tahun = $("#tahun_sisa_cuti option:selected").val();
            var sisatahun = $("#tahun_sisa_cuti option:selected").text();

            // pindahkan nilai ke input
            $("#tahun_cuti").val(tahun);
            $("#sisa_cuti").val(sisatahun);

            };
          </script>
          <script>
            window.setTimeout(function() {
              $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
              });
            }, 5000);
          </script>
        </div>
      </div>
    </div>
  </div>
@endsection