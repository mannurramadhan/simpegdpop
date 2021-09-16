<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //**UPDATE DATA HARIAN**//
        $now = date('d-m-Y');
        $pegawais = DB::table('pegawais')->get();
        foreach($pegawais as $pegawai)
        {
            // Update Umur Pegawai
            $tanggal_lahir = $pegawai->tanggal_lahir;
            $tanggal_lahir = \Carbon\Carbon::parse($tanggal_lahir);
            $now = \Carbon\Carbon::parse($now);
            
            $usia_now = \date_diff($tanggal_lahir,$now);

            DB::table('pegawais')->where('nip', '=', $pegawai->nip)->update([
                'usia' => $usia_now->y
            ]);

            // Update MKG
            $tahun_terakhir_kgb = $pegawai->tahun_terakhir_kgb;
            $tahun_baru_kgb = date('d-m-Y', strtotime('+2 year', strtotime($tahun_terakhir_kgb)));
            $tahun_terakhir_kgb = \Carbon\Carbon::parse($tahun_terakhir_kgb);
            $tahun_baru_kgb = \Carbon\Carbon::parse($tahun_baru_kgb);
            
            $mkg_now = \date_diff($tahun_terakhir_kgb,$tahun_baru_kgb);
            
            // CHECK UPDATE KGB
            $checkKgb = DB::select("SELECT*FROM notifs WHERE pegawais_nip = $pegawai->nip AND kategori = 'kgbs'");
            if($checkKgb == false){
                $kgbs = DB::table('kgbs')->where('pegawais_nip', '=', $pegawai->nip)->get();
                foreach($kgbs as $kgb){
                    if($kgb->durasi_kgb >=0 && $kgb->durasi_kgb <= 120){
                        DB::table('notifs')->insert([
                            'pegawais_nip' => $pegawai->nip,
                            'nama' => $pegawai->nama,
                            'kategori' => "kgbs"
                        ]);
                    }    
                }
            }

            // CHECK UPDATE KPP
            $check = DB::select("SELECT*FROM notifs WHERE pegawais_nip = $pegawai->nip AND kategori = 'kpps'");
            if($check == false){
                $kpps = DB::table('kpps')->where('pegawais_nip', '=', $pegawai->nip)->get();
                foreach($kpps as $kpp){
                    if($kpp->durasi_kpp >=0 && $kpp->durasi_kpp <= 120){
                        DB::table('notifs')->insert([
                            'pegawais_nip' => $pegawai->nip,
                            'nama' => $pegawai->nama,
                            'kategori' => "kpps"
                        ]);
                    }    
                }
            }
        }

        $notification = DB::table('notifs')->get();

        return view('dashboard',['notification' => $notification]);
    }

    public function update()
    {
        //**UPDATE DATA TAHUNAN**//
        $tahun = date('Y');
        $sekarang = date('d-m-Y');
        $awal_tahun = '01-01-'.$tahun.'';

        if($sekarang == $awal_tahun){
            //**UPDATE CUTI TAHUNAN**//
            $gets = DB::table('pegawais')
                    ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                    ->get();
            
            foreach($gets as $get){
                // Update Sisa Cuti Tahun N2
                if($get->sisa_tahun_n1 >= 6){
                    DB::table('pegawais')
                    ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                    ->update([
                        'sisa_tahun_n2' => 6
                    ]);
                }elseif($get->sisa_tahun_n1 < 6 && $get->sisa_tahun_n1 >= 0){
                    DB::table('pegawais')
                    ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                    ->update([
                        'sisa_tahun_n2' => $get->sisa_tahun_n1
                    ]);
                }else{
                    DB::table('pegawais')
                    ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                    ->update([
                        'sisa_tahun_n2' => 0
                    ]);
                }

                // Update Sisa Cuti Tahun N1
                if($get->sisa_tahun_n >= 6){
                    DB::table('pegawais')
                    ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                    ->update([
                        'sisa_tahun_n1' => 6
                    ]);
                }elseif($get->sisa_tahun_n < 6 && $get->sisa_tahun_n >= 0){
                    DB::table('pegawais')
                    ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                    ->update([
                        'sisa_tahun_n1' => $get->sisa_tahun_n
                    ]);
                }else{
                    DB::table('pegawais')
                    ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                    ->update([
                        'sisa_tahun_n1' => 0
                    ]);
                }

                // Update Sisa Cuti Tahun N
                DB::table('pegawais')
                ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                ->update([
                    'sisa_tahun_n' => 12
                ]);
            }
        }

        return back()->with(['success' => 'Update Tahunan Berhasil!']);
    }

    public function check(){
        

        dd($p);
    }
}
