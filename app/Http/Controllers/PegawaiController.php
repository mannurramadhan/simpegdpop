<?php

namespace App\Http\Controllers;

use App\Kgb;
use App\Kpp;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index()
    {
        $index = DB::table('pegawais')
                ->whereNotIn('status_kepegawaian', ['Pensiun', 'Mutasi'])
                ->paginate(10);

        $notification = DB::table('notifs')->get();

        return view('pages.dbpegawai.index', ['index' => $index, 'notification' => $notification]);
    }

    public function create()
    {
        $create = DB::table('gajis')->get();

        $notification = DB::table('notifs')->get();

        return view('pages.dbpegawai.create', ['create' => $create, 'notification' => $notification]);
    }

    public function store(Request $request)
    {
        // Input Pegawai Baru
        $tbpegawai = new Pegawai();
        $tbpegawai->nip = $request->nip;
        $tbpegawai->nik = $request->nik;
        $tbpegawai->nama = $request->nama;
        $tbpegawai->tempat_lahir = $request->tempat_lahir;
        $tbpegawai->tanggal_lahir = $request->tanggal_lahir;
        $tbpegawai->jenis_kelamin = $request->jenis_kelamin;
        $tbpegawai->pendidikan_terakhir = $request->pendidikan_terakhir;
        //$tbpegawai->usia = $request->usia;
        $tbpegawai->jabatan = $request->jabatan;
        $tbpegawai->eselon = $request->eselon;
        $tbpegawai->status_kepegawaian = $request->status_kepegawaian;
        $tbpegawai->gajis_id = $request->gajis_id;
        $tbpegawai->golongan = $request->golongan;
        $tbpegawai->mkg = $request->mkg;
        $tbpegawai->gaji_pegawai = 0;
        $tbpegawai->tahun_masuk_kerja = $request->tahun_masuk_kerja;
        $tbpegawai->sisa_tahun_n = $request->sisa_tahun_n;
        $tbpegawai->sisa_tahun_n1 = $request->sisa_tahun_n1;
        $tbpegawai->sisa_tahun_n2 = $request->sisa_tahun_n2;
        $tbpegawai->tahun_terakhir_kgb = $request->tahun_terakhir_kgb;
        $tbpegawai->tahun_terakhir_pangkat = $request->tahun_terakhir_pangkat;
        $tbpegawai->update_kgb = "NULL";
        $tbpegawai->update_pangkat = "NULL";
        $tbpegawai->update_pensiun = "NULL";
        $tbpegawai->durasi_pensiun = 0;
        
        // Perhitungan Tahun Pensiun
        $now = date('Y-m-d');

        $start = \Carbon\Carbon::parse($request->tanggal_lahir);
        $end = \Carbon\Carbon::parse($now);

        $umur = \date_diff($start,$end);
        $tbpegawai->umur = $umur;

        $eselon = substr($request->eselon,0,-2);

        if ( $eselon == "I" || $eselon == "II") {
            $masaPensiun = 60;
            //$stp = $mp - $u;
            $tahunPensiun = date('Y-m-d', strtotime('+'.$masaPensiun.' years', strtotime($request->tanggal_lahir)));
            $tbpegawai->tahun_pensiun = $tahunPensiun;
        } elseif ( $eselon == "III" || $eselon == "IV" || $eselon == "Non Eselon") {
            $masaPensiun = 58;
            //$stp = $mp - $u;
            $tahunPensiun = date('Y-m-d', strtotime('+'.$masaPensiun.' years', strtotime($request->tanggal_lahir)));
            $tbpegawai->tahun_pensiun = $tahunPensiun;
        }
        
        // Menyimpan Data Inputan
        $tbpegawai->save();

        // Perhitungan Kenaikan Gaji
        $gets = DB::table('gajis')->where('id','=',$request->gajis_id)->get();

        foreach ($gets as $get){
            $id = ($get->id) + 1;
        }

        $gets_up = DB::table('gajis')->where('id','=',$id)->get();

        foreach ($gets_up as $get_up){
            $up_gaji = $get_up->gaji_pokok;
        }

        $pegawais = DB::table('pegawais')->where('nip','=',$request->nip)->get();

        foreach ($pegawais as $pegawai){
            $now = date('d-m-Y');
            $tahun_kgb = date('d-m-Y', strtotime('+2 year', strtotime($request->tahun_terakhir_kgb)));
            $start = \Carbon\Carbon::parse($now);
            $end = \Carbon\Carbon::parse($tahun_kgb);
            
            $interval = \date_diff($start,$end);
            $date = $interval->format("%y Tahun, %m Bulan, %d Hari");
            $days = $interval->days;

            DB::table('pegawais')->where('nip','=',$pegawai->nip)->update([
                'update_kgb' => $date
            ]);

            DB::table('kgbs')->insert([
                'pegawais_nip' => $pegawai->nip,
                'kenaikan_gaji' => $up_gaji,
                'durasi_kgb' => $days,
                'status' => "Segera Ajukan!"
            ]);
        }

        // Perhitungan Kenaikan Pangkat
        $gets = DB::table('golongans')->where('golongan','=',$request->golongan)->get();

        foreach ($gets as $get){
            $id = ($get->id) + 1;
        }

        $gets_up = DB::table('golongans')->where('id','=',$id)->get();

        foreach ($gets_up as $get_up){
            $up_gol = $get_up->golongan;
        }

        $pegawais = DB::table('pegawais')->where('nip','=',$request->nip)->get();

        foreach ($pegawais as $pegawai){
            $now = date('d-m-Y');
            $tahun_kpp = date('d-m-Y', strtotime('+4 year', strtotime($request->tahun_terakhir_pangkat)));
            
            $start = \Carbon\Carbon::parse($now);
            $end = \Carbon\Carbon::parse($tahun_kpp);

            $interval = \date_diff($start,$end);
            $date = $interval->format("%y Tahun, %m Bulan, %d Hari");
            $days = $interval->days;
            
            DB::table('pegawais')->where('nip','=',$request->nip)->update([
                'update_pangkat' => $date
            ]);
            DB::table('kpps')->insert([
                'pegawais_nip' => $pegawai->nip,
                'kenaikan_golongan' => $up_gol,
                'durasi_kpp' => $days,
                'status' => "Segera Ajukan!"
            ]);
        }

        // Perhitungan Gaji Pegawai
        $gajis = DB::select("SELECT*FROM gajis WHERE mkg = $request->mkg AND golongan = '$request->golongan'");
                    
        if($gajis == true){
            $gajis = DB::select("SELECT*FROM gajis WHERE mkg = $request->mkg AND golongan = '$request->golongan'");
            foreach($gajis as $gaji){
                DB::table('pegawais')
                    ->where('nip','=',$request->nip)
                    ->update([
                        'gajis_id' => $gaji->id,
                        'gaji_pegawai' => $gaji->gaji_pokok
                    ]);
            }
        }else{
            $gajis = DB::select("SELECT*FROM gajis WHERE mkg = ($request->mkg - 1) AND golongan = '$request->golongan'");
            foreach($gajis as $gaji){
                DB::table('pegawais')
                    ->where('nip','=',$request->nip)
                    ->update([
                        'gajis_id' => $gaji->id,
                        'gaji_pegawai' => $gaji->gaji_pokok
                    ]);
            }
        }

        // Perhitungan Waktu Pensiun
        //$get = DB::table('pegawais')->get();

        $now = date('d-m-Y');
        $start = \Carbon\Carbon::parse($now);
        $end = \Carbon\Carbon::parse($tahunPensiun);

        $durasiPensiun = \date_diff($start,$end);
        $date = $durasiPensiun->format("%y Tahun, %m Bulan, %d Hari");
        $days = $durasiPensiun->days;

        DB::table('pegawais')->where('nip','=',$request->nip)->update([
            'update_pensiun' => $date,
            'durasi_pensiun' => $days
        ]);
        
        return back()->with(['success' => 'Data pegawai berhasil disimpan!']);
    }
    
    public function detail($nip)
    {
        $detail = DB::table('pegawais')
                ->where('nip', '=', $nip)
                ->get();

        $notification = DB::table('notifs')->get();

        return view('pages.dbpegawai.detail',['detail' => $detail, 'notification' => $notification]);
    }

    public function edit(Request $request)
    {
        // mengrequest data pegawai berdasarkan id yang dipilih
        $edit = DB::table('pegawais')
                ->where('nip','=',$request->nip)
                ->get();

        $notification = DB::table('notifs')->get();

	    // passing data pegawai yang didapat ke view edit.blade.php
        return view('pages.dbpegawai.edit',['edit' => $edit, 'notification' => $notification]);
    }

    public function update(Request $request)
    {
        // update data pasien
	    DB::table('pegawais')->where('nip','=',$request->nip)->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jabatan' => $request->jabatan,
            'eselon' => $request->eselon,
            'status_kepegawaian' => $request->status_kepegawaian,
            'golongan' => $request->golongan,  
            'mkg' =>$request->mkg,
            'tahun_masuk_kerja' => $request->tahun_masuk_kerja  
        ]);
	    // alihkan halaman ke halaman pegawai
	    return redirect('db-pegawai/info');
    }

    /**
     * Remove the specified user from storage
     *
     * 
     * @return \Illuminate\Http\RedirectResponse
     */

    public function delete($nip)
    {
	    // menghapus data pegawai berdasarkan id yang dipilih
	    DB::table('pegawais')->where('nip','=',$nip)->delete();
		
	    // alihkan halaman ke halaman pegawai
	    return redirect('db-pegawai/info')->withStatus(__('Pegawai successfully deleted.'));
    }
}