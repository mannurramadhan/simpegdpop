@extends('layouts.app', ['activePage' => 'input-pegawai', 'titlePage' => __('Input Data Pegawai'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('pegawai.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Input Data Pegawai') }}</h4>
                <p class="card-category">Silahkan isi form data pegawai berikut dengan benar!</p>
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
                    <div class="alert alert-success">
                      <span>{{ session('failed') }}</span>
                    </div>
                  </div>
                </div>
              @endif
                <div class="row form-group">
                  <div class="col-sm-6">
                    <label for="nip">NIP/NIK</label>
                    <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP atau NIK" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="no_ktp">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK atau No. KTP" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-6">
                    <label for="nama">NAMA LENGKAP</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap" required>
                  </div>
                  <div class="col-sm-2">
                    <label for="jenis_kelamin">JENIS KELAMIN</label>
                    <select class="form-control" data-style="btn btn-link" id="jenis_kelamin" name="jenis_kelamin" aria-placeholder="Jenis Kelamin" required>
                      <option value="">-</option>
                      <optgroup label="Jenis Kelamin:">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <label for="tempat_lahir">TEMPAT LAHIR</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat lahir" required>
                  </div>
                  <div class="col-sm-2">
                    <label for="tanggal_lahir">TANGGAL LAHIR</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal lahir" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-2">
                    <label for="usia">USIA</label>
                    <input type="number" class="form-control" id="usia" name="usia" placeholder="Usia" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="pendidikan_terakhir">PENDIDIKAN TERAKHIR</label>
                    <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" placeholder="Pendidikan Terakhir" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="jabatan">JABATAN</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-2">
                    <label for="eselon">ESELON</label>
                    <select class="form-control" data-style="btn btn-link" id="eselon" name="eselon" required>
                      <option value="">-</option>
                      <optgroup label="Non Eselon :">
                        <option value="Non Eselon-N">Non Eselon</option>
                      </optgroup>
                      <optgroup label="Eselon :">
                        <option value="I-A">I-A</option>
                        <option value="I-B">I-B</option>
                        <option value="II-A">II-A</option>
                        <option value="II-B">II-B</option>
                        <option value="III-A">III-A</option>
                        <option value="III-B">III-B</option>
                        <option value="IV-A">IV-A</option>
                        <option value="IV-B">IV-B</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <label for="status_kepegawaian">STATUS KEPEGAWAIAN</label>
                    <select class="form-control" data-style="btn btn-link" id="status_kepegawaian" name="status_kepegawaian" required>
                      <option value="">-</option>
                      <optgroup label="Status Kepegawaian:">
                        <option value="PNS">PNS</option>
                        <option value="Non PNS">Non PNS</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <label for="gajis_id">GAJIS ID</label>
                    <select class="form-control" data-style="btn btn-link" id="gajis_id" name="gajis_id" required>
                      <option value="">-</option>
                      <optgroup label="MKG|Golongan:">
                        @foreach($create as $gaji)
                        <option value="{{ $gaji->id }}">{{ $gaji->mkg }} | {{ $gaji->golongan }}</option>
                        @endforeach
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <label for="golongan">GOLONGAN</label>
                    <select class="form-control" data-link="btn btn-link" id="golongan" name="golongan" required>
                      <option value="">-</option>
                      <optgroup label="Golongan:">
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
                  <div class="col-sm-2">
                    <label for="mkg">MKG</label>
                    <input type="number" class="form-control" id="mkg" name="mkg" placeholder="MKG" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-3">
                    <label for="gaji_pegawai">GAJI PEGAWAI</label>
                    <input type="number" class="form-control" id="gaji_pegawai" name="gaji_pegawai" placeholder="(Kosongkan)" readonly>
                  </div>
                  <div class="col-sm-3">
                    <label for="sisa_tahun_n">SISA CUTI TAHUN (N)</label>
                    <input type="number" class="form-control" id="sisa_tahun_n" name="sisa_tahun_n" placeholder="Sisa Cuti Tahun (N)" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="sisa_tahun_n1">SISA CUTI TAHUN (N1)</label>
                    <input type="number" class="form-control" id="sisa_tahun_n1" name="sisa_tahun_n1" placeholder="Sisa Cuti Tahun (N1)" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="sisa_tahun_n2">SISA CUTI TAHUN (N2)</label>
                    <input type="number" class="form-control" id="sisa_tahun_n2" name="sisa_tahun_n2" placeholder="Sisa Cuti Tahun (N2)" required>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-3">
                    <label for="tahun_masuk_kerja">TAHUN MASUK KERJA</label>
                    <input type="date" class="form-control" id="tahun_masuk_kerja" name="tahun_masuk_kerja" placeholder="Tahun masuk kerja" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="tahun_terakhir_kgb">TAHUN TERAKHIR KGB</label>
                    <input type="date" class="form-control" id="tahun_terakhir_kgb" name="tahun_terakhir_kgb" placeholder="Tahun Terakhir Kgb" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="tahun_terakhir_pangkat">TAHUN TERAKHIR PANGKAT</label>
                    <input type="date" class="form-control" id="tahun_terakhir_pangkat" name="tahun_terakhir_pangkat" placeholder="Tahun Terakhir Pangkat" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="tahun_pensiun">TAHUN PENSIUN</label>
                    <input type="text" class="form-control" id="tahun_pensiun" name="tahun_pensiun" placeholder="(Kosongkan)" readonly>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                <a class="btn btn-primary" href="{{ route('pegawai.index') }}">{{ __('Batal') }}</a>
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