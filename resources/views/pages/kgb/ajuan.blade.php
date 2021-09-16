@extends('layouts.app', ['activePage' => 'notif-kgb', 'titlePage' => __('Verifikasi Kenaikan Gaji Berkala Pegawai'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @foreach($ajuankgb as $kgb)
          <form method="post" action="{{ route('kgb.update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Verifikasi Kenaikan Gaji Berkala Pegawai') }}</h4>
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
                        <option value="{{ $kgb->nip }}">{{ $kgb->nama }} / {{ $kgb->nip }}</option>
                      </optgroup>
                    </select>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-6">
                    <label for="nama">NAMA LENGKAP</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="gaji_baru">GAJI BARU</label>
                    <input type="text" class="form-control" id="gaji_baru" name="gaji_baru" placeholder="Gaji Baru" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="gaji_lama">GAJI LAMA</label>
                    <input type="text" class="form-control" value="{{ $kgb->gaji_baru }}" id="gaji_lama" name="gaji_lama" placeholder="Gaji Lama" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-3">
                    <label for="pejabat_baru">PEJABAT BARU</label>
                    <input type="text" class="form-control" id="pejabat_baru" name="pejabat_baru" placeholder="PEJABAT BARU" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="pejabat_lama">PEJABAT LAMA</label>
                    <input type="text" class="form-control" value="{{ $kgb->pejabat_baru }}" id="pejabat_lama" name="pejabat_lama" placeholder="PEJABAT Lama" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="no_sk_baru">NOMOR SK BARU</label>
                    <input type="text" class="form-control" id="no_sk_baru" name="no_sk_baru" placeholder="Nomor SK Baru" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="no_sk_lama">NOMOR SK LAMA</label>
                    <input type="text" class="form-control" value="{{ $kgb->no_sk_baru }}" id="no_sk_lama" name="no_sk_lama" placeholder="Nomor SK Lama" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-3">
                    <label for="tanggal_sk_baru">TANGGAL SK BARU</label>
                    <input type="date" class="form-control" id="tanggal_sk_baru" name="tanggal_sk_baru" placeholder="Tanggal SK Baru" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="tanggal_sk_lama">TANGGAL SK LAMA</label>
                    <input type="date" class="form-control" value="{{ $kgb->tanggal_sk_baru }}" id="tanggal_sk_lama" name="tanggal_sk_lama" placeholder="Tanggal SK Lama" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="mkg_baru">MKG BARU</label>
                    <input type="number" class="form-control" id="mkg_baru" name="mkg_baru" placeholder="MKG Baru" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="mkg_lama">MKG LAMA</label>
                    <input type="number" class="form-control" value="{{ $kgb->mkg_baru }}"    id="mkg_lama" name="mkg_lama" placeholder="MKG Lama" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-3">
                    <label for="tmt_baru">TMT BARU</label>
                    <select class="form-control" onchange="ambiltmt()" data-style="btn btn-link" id="tmt_baru" name="tmt_baru" required>
                      <?php
                          $now = date('Y');
                          $mar = "$now-03-01";
                          $oct = "$now-10-01";
                      ?>
                      <optgroup label="Periode :">
                        <option value="">Periode :</option>
                        <option value="<?php echo $mar;?>">Maret</option>
                        <option value="<?php echo $oct;?>">Oktober</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <label for="tmt_lama">TMT LAMA</label>
                    <select class="form-control" data-style="btn btn-link" id="tmt_lama" name="tmt_lama" required>
                      <optgroup label="Selected :">
                        <option value="{{ $kgb->tmt_baru }}" selected>{{ $kgb->tmt_baru }}</option>
                        <option value="0001-01-01">Tidak Ada</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <label for="tanggal_kgb_baru">TANGGAL KGB BARU</label>
                    <?php
                      $now = date('Y');
                      $next = date('Y', strtotime('+4 year', strtotime($now)));
                      $mar = "$next-03-01";
                      $oct = "$next-10-01";
                    ?>
                    <input type="date" class="form-control" id="tanggal_kgb_baru" name="tanggal_kgb_baru" placeholder="Tanggal KGB Baru" required>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Simpan Ajuan') }}</button>
                <a class="btn btn-primary" href="{{ route('kgb.notif') }}">{{ __('Kembali') }}</a>
              </div>
            </div>
          </form>
          @endforeach
          <script type="text/javascript">
            function ambiltmt(){

            // ambil nilai
            var tahun = $("#tmt_baru option:selected").val();

            // pindahkan nilai ke input
            $("#tanggal_kgb_baru").val(tahun);

            };
          </script>
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