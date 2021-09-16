@extends('layouts.app', ['activePage' => 'notif-kpp', 'titlePage' => __('Verifikasi Kenaikan Pangkat Pegawai'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('kpp.update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Verifikasi Kenaikan Pangkat Pegawai') }}</h4>
                <p class="card-category">Silahkan isi form berikut dengan benar!</p>
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
                <div class="row form-group">
                  <div class="col-sm-6">
                    <label for="nip">NAMA / NIP</label>
                    <select class="form-control" data-style="btn btn-link" id="nip" name="nip" required>
                      <optgroup label="NIP/NIK :">
                        @foreach($ajuan as $kpp)
                        <option value="{{ $kpp->nip }}">{{ $kpp->nama }} / {{ $kpp->nip }}</option>
                        @endforeach
                      </optgroup>
                    </select>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-4">
                    <label for="nama">NAMA LENGKAP</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="golongan_baru">GOLONGAN BARU</label>
                    <select class="form-control" data-link="btn btn-link" id="golongan_baru" name="golongan_baru" required>
                      <optgroup label="Golongan:">
                        <option value="">Pilih Golongan :</option>
                        <option value="I/A">I/A</option>
                        <option value="I/B">I/B</option>
                        <option value="I/C">I/C</option>
                        <option value="I/D">I/D</option>
                        <option value="II/A">II/A</option>
                        <option value="II/B">II/B</option>
                        <option value="II/C">II/C</option>
                        <option value="II/D">II/D</option>
                        <option value="III/A">III/A</option>
                        <option value="III/B">III/B</option>
                        <option value="III/C">III/C</option>
                        <option value="III/D">III/D</option>
                        <option value="IV/A">IV/A</option>
                        <option value="IV/B">IV/B</option>
                        <option value="IV/C">IV/C</option>
                        <option value="IV/D">IV/D</option>
                        <option value="IV/E">IV/E</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <label for="gaji_pokok_baru">GAJI POKOK BARU</label>
                    <input type="number" class="form-control" id="gaji_pokok_baru" name="gaji_pokok_baru" placeholder="Gaji Pokok Baru" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-3">
                    <label for="pejabat">PEJABAT</label>
                    <input type="text" class="form-control" id="pejabat" name="pejabat" placeholder="PEJABAT" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="no_sk">NOMOR SK</label>
                    <input type="text" class="form-control" id="no_sk" name="no_sk" placeholder="Nomor SK" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="tanggal_sk">TANGGAL SK</label>
                    <input type="date" class="form-control" id="tanggal_sk" name="tanggal_sk" placeholder="Tanggal SK" required>
                  </div>
                  <div class="col-sm-2">
                    <label for="tmt">TMT</label>
                    <select class="form-control" data-style="btn btn-link" id="tmt" name="tmt" required>
                        <?php
                            $now = date('Y');
                            $next = date('Y', strtotime('+4 year', strtotime($now)));
                            $mar = "$next-03-01";
                            $oct = "$next-10-01";
                        ?>
                      <optgroup label="Periode :">
                        <option value="">Periode :</option>
                        <option value="<?php echo $mar;?>">Maret</option>
                        <option value="<?php echo $oct;?>">Oktober</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-sm-1">
                    <label for="mkg_baru">MKG BARU</label>
                    <input type="number" class="form-control" id="mkg_baru" name="mkg_baru" placeholder="(Kosongkan)" required readonly>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Simpan Ajuan') }}</button>
                <a class="btn btn-primary" href="{{ route('kpp.notif') }}">{{ __('Kembali') }}</a>
              </div>
            </div>
          </form>
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