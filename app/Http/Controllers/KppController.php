<?php

namespace App\Http\Controllers;

use App\Kgb;
use App\Kpp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KppController extends Controller
{
    public function index(){
        $index = DB::table('pegawais')
                ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                ->paginate(10);

        $notification = DB::table('notifs')->get();

        return view('pages.kpp.index', ['index' => $index, 'notification' => $notification]);
    }

    public function notif()
    {
        $get = DB::table('pegawais')->get();

        foreach($get as $n){
            $now = date('d-m-Y');
            $tahun_kpp = date('d-m-Y', strtotime('+4 year', strtotime($n->tahun_terakhir_pangkat)));
            
            $start = \Carbon\Carbon::parse($now);
            $end = \Carbon\Carbon::parse($tahun_kpp);

            $interval = \date_diff($start,$end);
            $date = $interval->format("%y Tahun, %m Bulan, %d Hari");
            $days = $interval->days;
            
            DB::table('pegawais')->where('nip','=',$n->nip)->update([
                'update_pangkat' => $date
            ]);

            DB::table('kpps')->where('pegawais_nip','=',$n->nip)->update([
                'durasi_kpp' => $days
            ]);
        }

        $notif = DB::table('kpps')
                ->leftJoin('pegawais', 'pegawais_nip', '=', 'pegawais.nip')
                ->whereIn('pegawais.status_kepegawaian', ['PNS', 'Non PNS'])
                ->whereBetween('durasi_kpp', [0, 150])
                ->paginate(10);
        
        $notification = DB::table('notifs')->get();

        return view('pages.kpp.notif', ['notif' => $notif, 'notification' => $notification]);
    }

    public function ajuan($nip){
        $ajuan = DB::table('pegawais')
                ->where('nip', '=', $nip)
                ->get();

        $notification = DB::table('notifs')->get();

        return view('pages.kpp.ajuan', ['ajuan' => $ajuan, 'notification' => $notification]);
    }

    public function detail($nip){
        $detail = DB::table('pengajuan_kpps')
                ->leftJoin('pegawais', 'pegawais_nip', '=', 'pegawais.nip')
                ->where('pegawais.nip', '=', $nip)
                ->get();

        $notification = DB::table('notifs')->get();
        
        return view('pages.kpp.detail', ['detail' => $detail, 'notification' => $notification]);
    }

    public function update(Request $request)
    {
        $pegawais = DB::table('pegawais')->get();
        foreach($pegawais as $pegawai)
        {
            // Update MKG Pegawai
            $tahun_masuk_kerja = date('d-m-Y', strtotime($pegawai->tahun_masuk_kerja));;

            $tahun_masuk_kerja = \Carbon\Carbon::parse($tahun_masuk_kerja);
            $tmt = \Carbon\Carbon::parse($request->tmt);
        
            $masa_kerja = \date_diff($tahun_masuk_kerja, $tmt);
            $mkg = $pegawai->mkg;

            $mkg_baru = $masa_kerja->format("$mkg Tahun, %m Bulan");
            DB::table('pengajuan_kpps')
            ->insert([
                'pegawais_nip' => $request->nip,
                'golongan_baru' => $request->golongan_baru,
                'tmt' => $request->tmt,
                'gaji_pokok_baru' => $request->gaji_pokok_baru,
                'pejabat' => $request->pejabat,
                'no_sk' => $request->no_sk,
                'tanggal_sk' => $request->tanggal_sk,
                'mkg_baru' => $mkg_baru              
            ]);
            DB::table('kpps')
                ->where('pegawais_nip', '=', $request->nip)
                ->update([
                    'status' => "Verifikasi!"
                ]);
        }
        
        return redirect('kenaikan-pangkat/notif')->with(['success' => 'Data kenaikan pangkat pegawai berhasil diajukan!']);
    }

    public function verify($nip){
        //** VERIFIKASI KENAIKAN PANGKAT **//
        $gets = DB::table('kpps')->where('pegawais_nip','=',$nip)->get();
        foreach($gets as $get){
            if($get->kenaikan_golongan == "II/A"){
                // Mengubah MKG & Golongan Pegawai di Tabel Pegawais
                $pegawais = DB::table('pegawais')
                            ->where('nip','=',$nip)
                            ->get();
                
                foreach($pegawais as $pegawai){
                    DB::table('pegawais')
                        ->where('nip','=',$nip)
                        ->update([
                            'golongan' => $get->kenaikan_golongan,
                            'mkg' => $pegawai->mkg - 6
                        ]);
                }
                
                // Mengubah Kenaikan Golongan di Tabel Kpps
                $pegawais = DB::table('pegawais')
                            ->where('nip','=',$nip)
                            ->get();

                foreach($pegawais as $pegawai){
                    $gols = DB::table('golongans')->where('golongan','=',$pegawai->golongan)->get();
                    
                    foreach ($gols as $gol){
                        $id = ($gol->id) + 1;
                    }
                }
                
                $gols_up = DB::table('golongans')->where('id','=',$id)->get();
                    
                foreach ($gols_up as $gol_up){
                    DB::table('kpps')
                        ->where('pegawais_nip', '=', $nip)
                        ->update([
                            'kenaikan_golongan' => $gol_up->golongan
                        ]);
                }
                
                // Mengubah Gaji Pegawai di Tabel Pegawais
                $ambils = DB::table('pegawais')
                            ->where('nip','=',$nip)
                            ->get();

                foreach($ambils as $ambil){
                    $gajis = DB::select("SELECT*FROM gajis WHERE mkg = $ambil->mkg AND golongan = '$ambil->golongan'");
                    
                    if($gajis == true){
                        $gajis = DB::select("SELECT*FROM gajis WHERE mkg = $ambil->mkg AND golongan = '$ambil->golongan'");
                        foreach($gajis as $gaji){
                            DB::table('pegawais')
                                ->where('nip','=',$nip)
                                ->update([
                                    'gajis_id' => $gaji->id,
                                    'gaji_pegawai' => $gaji->gaji_pokok
                                ]);
                        }
                    }else{
                        $gajis = DB::select("SELECT*FROM gajis WHERE mkg = ($ambil->mkg - 1) AND golongan = '$ambil->golongan'");
                        foreach($gajis as $gaji){
                            DB::table('pegawais')
                                ->where('nip','=',$nip)
                                ->update([
                                    'gajis_id' => $gaji->id,
                                    'gaji_pegawai' => $gaji->gaji_pokok
                                ]);
                        }
                    }
                }
            }elseif($get->kenaikan_golongan == "III/A"){
                // Mengubah MKG & Golongan Pegawai di Tabel Pegawais
                $pegawais = DB::table('pegawais')
                            ->where('nip','=',$nip)
                            ->get();
                
                foreach($pegawais as $pegawai){
                    DB::table('pegawais')
                        ->where('nip','=',$nip)
                        ->update([
                            'golongan' => $get->kenaikan_golongan,
                            'mkg' => $pegawai->mkg - 5
                        ]);
                }
                
                // Mengubah Kenaikan Golongan di Tabel Kpps
                $pegawais = DB::table('pegawais')
                            ->where('nip','=',$nip)
                            ->get();

                foreach($pegawais as $pegawai){
                    $gols = DB::table('golongans')->where('golongan','=',$pegawai->golongan)->get();
                    
                    foreach ($gols as $gol){
                        $id = ($gol->id) + 1;
                    }
                }
                
                $gols_up = DB::table('golongans')->where('id','=',$id)->get();
                    
                foreach ($gols_up as $gol_up){
                    DB::table('kpps')
                        ->where('pegawais_nip', '=', $nip)
                        ->update([
                            'kenaikan_golongan' => $gol_up->golongan
                        ]);
                }
                
                // Mengubah Gaji Pegawai di Tabel Pegawais
                $ambils = DB::table('pegawais')
                            ->where('nip','=',$nip)
                            ->get();

                foreach($ambils as $ambil){
                    $gajis = DB::select("SELECT*FROM gajis WHERE mkg = $ambil->mkg AND golongan = '$ambil->golongan'");
                    
                    if($gajis == true){
                        $gajis = DB::select("SELECT*FROM gajis WHERE mkg = $ambil->mkg AND golongan = '$ambil->golongan'");
                        foreach($gajis as $gaji){
                            DB::table('pegawais')
                                ->where('nip','=',$nip)
                                ->update([
                                    'gajis_id' => $gaji->id,
                                    'gaji_pegawai' => $gaji->gaji_pokok
                                ]);
                        }
                    }else{
                        $gajis = DB::select("SELECT*FROM gajis WHERE mkg = ($ambil->mkg - 1) AND golongan = '$ambil->golongan'");
                        foreach($gajis as $gaji){
                            DB::table('pegawais')
                                ->where('nip','=',$nip)
                                ->update([
                                    'gajis_id' => $gaji->id,
                                    'gaji_pegawai' => $gaji->gaji_pokok
                                ]);
                        }
                    }
                }
            }else{
                // Mengubah MKG & Golongan Pegawai di Tabel Pegawais
                $pegawais = DB::table('pegawais')
                            ->where('nip','=',$nip)
                            ->get();
                
                foreach($pegawais as $pegawai){
                    DB::table('pegawais')
                        ->where('nip','=',$nip)
                        ->update([
                            'golongan' => $get->kenaikan_golongan,
                        ]);
                }
                
                // Mengubah Kenaikan Golongan di Tabel Kpps
                $pegawais = DB::table('pegawais')
                            ->where('nip','=',$nip)
                            ->get();

                foreach($pegawais as $pegawai){
                    $gols = DB::table('golongans')->where('golongan','=',$pegawai->golongan)->get();
                    
                    foreach ($gols as $gol){
                        $id = ($gol->id) + 1;
                    }
                }
                
                $gols_up = DB::table('golongans')->where('id','=',$id)->get();
                    
                foreach ($gols_up as $gol_up){
                    DB::table('kpps')
                        ->where('pegawais_nip', '=', $nip)
                        ->update([
                            'kenaikan_golongan' => $gol_up->golongan
                        ]);
                }
                
                // Mengubah Gaji Pegawai di Tabel Pegawais
                $ambils = DB::table('pegawais')
                            ->where('nip','=',$nip)
                            ->get();

                foreach($ambils as $ambil){
                    $gajis = DB::select("SELECT*FROM gajis WHERE mkg = $ambil->mkg AND golongan = '$ambil->golongan'");
                    
                    if($gajis == true){
                        $gajis = DB::select("SELECT*FROM gajis WHERE mkg = $ambil->mkg AND golongan = '$ambil->golongan'");
                        foreach($gajis as $gaji){
                            DB::table('pegawais')
                                ->where('nip','=',$nip)
                                ->update([
                                    'gajis_id' => $gaji->id,
                                    'gaji_pegawai' => $gaji->gaji_pokok
                                ]);
                        }
                    }else{
                        $gajis = DB::select("SELECT*FROM gajis WHERE mkg = ($ambil->mkg - 1) AND golongan = '$ambil->golongan'");
                        foreach($gajis as $gaji){
                            DB::table('pegawais')
                                ->where('nip','=',$nip)
                                ->update([
                                    'gajis_id' => $gaji->id,
                                    'gaji_pegawai' => $gaji->gaji_pokok
                                ]);
                        }
                    }
                }
            }
        }
        
        //** UPDATE TAHUN TERAKHIR KPP & DURASI KPP BARU **//
        $kpps = DB::table('pengajuan_kpps')->where('pegawais_nip', '=', $nip)->get();
        foreach($kpps as $kpp){
            $tmt = $kpp->tmt;

            DB::table('pegawais')->where('nip', '=', $nip)->update([
                'tahun_terakhir_pangkat' => $tmt
            ]);
        
            $gets = DB::table('pegawais')->get();
            $now = date('Y-m-d');

            foreach($gets as $get){
                $start = \Carbon\Carbon::parse($now);
                $end = \Carbon\Carbon::parse($get->tahun_terakhir_pangkat);
                $interval = \date_diff($start,$end);
            }

            $date = $interval->format("%y Tahun, %m Bulan, %d Hari");
            $days = $interval->days;

            DB::table('pegawais')->where('nip', '=', $nip)->update([
                'update_pangkat' => $date
            ]);
        
            DB::table('kpps')->where('pegawais_nip', '=', $nip)->update([
                'durasi_kpp' => $days,
                'status' => "Segeja Ajukan!"
            ]);
        }
        
        // Menghapus record di tabel notifs
        DB::select("DELETE FROM notifs WHERE pegawais_nip = ($nip) AND kategori = 'kpps'");
        
        return redirect('kenaikan-pangkat/info')->with(['success' => 'Data kenaikan pangkat pegawai berhasil diverifikasi!']);
    }
}
