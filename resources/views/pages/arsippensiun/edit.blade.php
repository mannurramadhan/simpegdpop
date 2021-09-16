@extends('layouts.app', ['activePage' => 'arsip-pensiun', 'titlePage' => __('Ubah Informasi Pegawai Pensiun'), 'notification' => $notification])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          @foreach($edit as $pensiun)
          <form method="POST" action="{{ route('arsipp.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Ubah Informasi Pegawai Pensiun') }}</h4>
                <p class="card-category">Silahkan ubah informasi pegawai berikut dengan benar!</p>
              </div>
              <div class="card-body">
                <div class="row form-group">
                  <div class="col-sm-3">
                    <label for="nip">NIP/NIK</label>
                    <input type="text" class="form-control" value="{{ $pensiun->nip }}" id="nip" name="nip" placeholder="NIP atau NIK" required readonly>
                  </div>
                  <div class="col-sm-3">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" value="{{ $pensiun->nik }}" id="nik" name="nik" placeholder="NIK atau No. KTP" required readonly>
                  </div>
                  <div class="col-sm-4">
                    <label for="nama">NAMA LENGKAP</label>
                    <input type="text" class="form-control" value="{{ $pensiun->nama }}" id="nama" name="nama" placeholder="Nama lengkap" required readonly>
                  </div>
                  <div class="col-sm-2">
                    <label for="jenis_kelamin">JENIS KELAMIN</label>
                    <select class="form-control" data-style="btn btn-link" value="{{ $pensiun->jenis_kelamin }}" id="jenis_kelamin" name="jenis_kelamin" required readonly>
                      <optgroup label="Selected :">
                        <option value="{{ $pensiun->jenis_kelamin }}" selected>{{ $pensiun->jenis_kelamin }}</option>
                      </optgroup>
                      <optgroup label="Jenis Kelamin:">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </optgroup>
                    </select>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-3">
                    <label for="tempat_lahir">TEMPAT LAHIR</label>
                    <input type="text" class="form-control" value="{{ $pensiun->tempat_lahir }}" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat lahir" required readonly>
                  </div>
                  <div class="col-sm-2">
                    <label for="tanggal_lahir">TANGGAL LAHIR</label>
                    <input type="date" class="form-control" value="{{ $pensiun->tanggal_lahir }}" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal lahir" required readonly>
                  </div>
                  <div class="col-sm-2">
                    <label for="pendidikan_terakhir">PENDIDIKAN TERAKHIR</label>
                    <input type="text" class="form-control" value="{{ $pensiun->pendidikan_terakhir }}" id="pendidikan_terakhir" name="pendidikan_terakhir" placeholder="Pendidikan Terakhir" required>
                  </div>
                  <div class="col-sm-1">
                    <label for="usia">USIA</label>
                    <input type="number" class="form-control" value="{{ $pensiun->usia }}" id="usia" name="usia" placeholder="Usia" required readonly>
                  </div>
                  <div class="col-sm-4">
                    <label for="jabatan">JABATAN</label>
                    <input type="text" class="form-control" value="{{ $pensiun->jabatan }}" id="jabatan" name="jabatan" placeholder="Jabatan" required readonly>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-2">
                    <label for="eselon">ESELON</label>
                    <select class="form-control" data-style="btn btn-link" value="{{ $pensiun->eselon }}" id="eselon" name="eselon" required readonly>
                      <optgroup label="Selected :">
                        <option value="{{ $pensiun->eselon }}" selected>{{ $pensiun->eselon }}</option>
                      </optgroup>
                      <optgroup label="Non Eselon :">
                        <option value="Non Eselon-N">Non Eselon</option>
                      </optgroup>
                      <optgroup label="Eselon :">
                        <option value="I-A">I-A</option>
                        <option value="I-B">I-B</option>
                        <option value="II-A">II-A</option>
                        <option value="II-B">II-B</option>
                        <option value="III-A">III-A</option>
                        <option value="III-B">IIIb</option>
                        <option value="IV-A">IV-A</option>
                        <option value="IV-B">IV-B</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <label for="status_kepegawaian">STATUS KEPEGAWAIAN</label>
                    <select class="form-control" data-style="btn btn-link" value="{{ $pensiun->status_kepegawaian }}" id="status_kepegawaian" name="status_kepegawaian" required readonly>
                      <optgroup label="Selected :">
                        <option value="{{ $pensiun->status_kepegawaian }}" selected>{{ $pensiun->status_kepegawaian }}</option>
                      </optgroup>
                      <optgroup label="Status Kepegawaian:">
                        <option value="PNS">PNS</option>
                        <option value="Non PNS">Non PNS</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <label for="gajis_id">GAJIS ID</label>
                    <select class="form-control" data-style="btn btn-link" value="{{ $pensiun->gajis_id }}" id="gajis_id" name="gajis_id" required readonly>
                      <optgroup label="Selected :">
                        <option value="{{ $pensiun->gajis_id }}" selected>{{ $pensiun->gajis_id }}</option>
                      </optgroup>
                      <optgroup label="MKG/Golongan:">
                        <option value="1">0/IA</option>
                        <option value="2">2/IA</option>
                        <option value="3">4/IA</option>
                        <option value="4">6/IA</option>
                        <option value="5">8/IA</option>
                        <option value="6">10/IA</option>
                        <option value="7">12/IA</option>
                        <option value="8">14/IA</option>
                        <option value="9">16/IA</option>
                        <option value="10">18/IA</option>
                        <option value="11">20/IA</option>
                        <option value="12">22/IA</option>
                        <option value="13">24/IA</option>
                        <option value="14">26/IA</option>
                      </optgroup>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <label for="golongan">GOLONGAN</label>
                    <select class="form-control" data-link="btn btn-link" value="{{ $pensiun->golongan }}" id="golongan" name="golongan" required readonly>
                      <optgroup label="Selected :">
                        <option value="{{ $pensiun->golongan }}" selected>{{ $pensiun->golongan }}</option>
                      </optgroup>
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
                    <input type="number" class="form-control" value="{{ $pensiun->mkg }}" id="mkg" name="mkg" placeholder="MKG" required readonly>
                  </div>
                  <div class="col-sm-2">
                    <label for="gaji_pegawai">GAJI PEGAWAI</label>
                    <input type="number" class="form-control" value="{{ $pensiun->gaji_pegawai }}" id="gaji_pegawai" name="gaji_pegawai" placeholder="Gaji Pegawai" required readonly>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-3">
                    <label for="sisa_tahun_n">SISA CUTI TAHUN (N)</label>
                    <input type="number" class="form-control" value="{{ $pensiun->sisa_tahun_n }}" id="sisa_tahun_n" name="sisa_tahun_n" placeholder="Sisa Cuti Tahun (N)" required readonly>
                  </div>
                  <div class="col-sm-3">
                    <label for="sisa_tahun_n1">SISA CUTI TAHUN (N1)</label>
                    <input type="number" class="form-control" value="{{ $pensiun->sisa_tahun_n1 }}" id="sisa_tahun_n1" name="sisa_tahun_n1" placeholder="Sisa Cuti Tahun (N1)" required readonly>
                  </div>
                  <div class="col-sm-3">
                    <label for="sisa_tahun_n2">SISA CUTI TAHUN (N2)</label>
                    <input type="number" class="form-control" value="{{ $pensiun->sisa_tahun_n2 }}" id="sisa_tahun_n2" name="sisa_tahun_n2" placeholder="Sisa Cuti Tahun (N2)" required readonly>
                  </div>
                  <div class="col-sm-3">
                    <label for="tahun_masuk_kerja">TAHUN MASUK KERJA</label>
                    <input type="date" class="form-control" value="{{ $pensiun->tahun_masuk_kerja }}" id="tahun_masuk_kerja" name="tahun_masuk_kerja" placeholder="Tahun masuk kerja" required readonly>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-sm-3">
                    <label for="tahun_terakhir_kgb">TAHUN TERAKHIR KGB</label>
                    <input type="date" class="form-control" value="{{ $pensiun->tahun_terakhir_kgb }}" id="tahun_terakhir_kgb" name="tahun_terakhir_kgb" placeholder="Tahun Terakhir Kgb" required readonly>
                  </div>
                  <div class="col-sm-3">
                    <label for="tahun_terakhir_pangkat">TAHUN TERAKHIR PANGKAT</label>
                    <input type="date" class="form-control" value="{{ $pensiun->tahun_terakhir_pangkat }}" id="tahun_terakhir_pangkat" name="tahun_terakhir_pangkat" placeholder="Tahun Terakhir Pangkat" required readonly>
                  </div>
                  <div class="col-sm-3">
                    <label for="tahun_pensiun">TAHUN PENSIUN</label>
                    <input type="date" class="form-control" value="{{ $pensiun->tahun_pensiun }}" id="tahun_pensiun" name="tahun_pensiun" placeholder="Tahun Pensiun" required readonly>
                  </div>
                  <div class="col-sm-3">
                    <label for="tahun_pensiun_mutasi">TANGGAL RESMI PENSIUN</label>
                    <input type="date" class="form-control" id="tahun_pensiun_mutasi" name="tahun_pensiun_mutasi" placeholder="Tahun Resmi Pensiun" required>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                <a class="btn btn-primary" href="{{ route('arsipp.index') }}">{{ __('Kembali') }}</a>
              </div>
            </div>
          </form>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection