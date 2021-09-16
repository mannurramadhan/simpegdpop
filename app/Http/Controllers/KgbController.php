<?php

namespace App\Http\Controllers;

use App\Kgb;
use App\Kpp;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KgbController extends Controller
{
    public function index(){
        $index = DB::table('pegawais')
                ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                ->paginate(10);
        
        $notification = DB::table('notifs')->get();

        return view('pages.kgb.index', ['index' => $index, 'notification' => $notification]);
    }

    public function notif()
    {
        $get = DB::table('pegawais')->get();

        foreach($get as $n){
            $now = date('d-m-Y');
            $tahun_kgb = date('d-m-Y', strtotime('+2 year', strtotime($n->tahun_terakhir_kgb)));
            $start = \Carbon\Carbon::parse($now);
            $end = \Carbon\Carbon::parse($tahun_kgb);
            
            $interval = \date_diff($start,$end);
            $date = $interval->format("%y Tahun, %m Bulan, %d Hari");
            $days = $interval->days;

            DB::table('pegawais')->where('nip','=',$n->nip)->update([
                'update_kgb' => $date
            ]);

            DB::table('kgbs')->where('pegawais_nip','=',$n->nip)->update([
                'durasi_kgb' => $days
            ]);
        }

        $notif = DB::table('kgbs')
                ->leftJoin('pegawais', 'pegawais_nip', '=', 'pegawais.nip')
                ->whereIn('pegawais.status_kepegawaian', ['PNS', 'Non PNS'])
                ->whereBetween('durasi_kgb', [0, 120])
                ->paginate(10);

        $notification = DB::table('notifs')->get();

        return view('pages.kgb.notif', ['notif' => $notif, 'notification' => $notification]);
    }

    public function ajuan($nip){
        $ajuankgb = DB::table('pengajuan_kgbs')
                ->rightJoin('pegawais', 'pegawais_nip', '=', 'pegawais.nip')
                ->where('pegawais.nip', '=', $nip)
                ->get();

        $notification = DB::table('notifs')->get();

        return view('pages.kgb.ajuan', ['ajuankgb' => $ajuankgb, 'notification' => $notification]);
    }

    public function detail($nip){
        $detail = DB::table('pengajuan_kgbs')
                ->leftJoin('pegawais', 'pegawais_nip', '=', 'pegawais.nip')
                ->where('pegawais.nip', '=', $nip)
                ->get();
               
        $notification = DB::table('notifs')->get();
                
        return view('pages.kgb.detail', ['detail' => $detail, 'notification' => $notification]);
    }

    public function update(Request $request){
        DB::table('pengajuan_kgbs')
            ->insert([
                'pegawais_nip' => $request->nip,
                'gaji_baru' => $request->gaji_baru,
                'gaji_lama' => $request->gaji_lama,
                'pejabat_baru' => $request->pejabat_baru,
                'pejabat_lama' => $request->pejabat_lama,
                'no_sk_baru' => $request->no_sk_baru,
                'no_sk_lama' => $request->no_sk_lama,
                'tanggal_sk_baru' => $request->tanggal_sk_baru,
                'tanggal_sk_lama' => $request->tanggal_sk_lama,
                'mkg_baru' => $request->mkg_baru,
                'mkg_lama' => $request->mkg_lama,
                'tmt_baru' => $request->tmt_baru,
                'tmt_lama' => $request->tmt_lama,
                'tanggal_kgb_baru' => $request->tanggal_kgb_baru
            ]);
        
        DB::table('kgbs')
            ->where('pegawais_nip', '=', $request->nip)
            ->update([
                'status' => "Verifikasi!"
            ]);
        return redirect('kenaikan-gaji/notif')->with(['success' => 'Data kenaikan gaji berkala pegawai berhasil diajukan!']);
    }

    public function verify($nip){
        //**KENAIKAN GAJI BERKALA**//
        $pegawais = DB::table('pegawais')
                    ->where('nip','=',$nip)
                    ->get();

        foreach($pegawais as $pegawai){
            $gajis = DB::select("SELECT*FROM gajis WHERE mkg = ($pegawai->mkg + 2) AND golongan = '$pegawai->golongan'");
            if($gajis == true){
                foreach ($gajis as $gaji){
                    DB::table('kgbs')->where('pegawais_nip', '=', $nip)->update([
                        'kenaikan_gaji' => $gaji->gaji_pokok
                    ]);

                    $kgbs = DB::table('kgbs')->where('pegawais_nip', '=', $nip)->get();
                    foreach($kgbs as $kgb){
                        DB::table('pegawais')->where('nip', '=', $nip)->update([
                            'gaji_pegawai' => $kgb->kenaikan_gaji,
                            'mkg' => $gaji->mkg,
                            'gajis_id' => $gaji->id
                        ]);
                    }
                }

                //** UPDATE TAHUN TERAKHIR KGB & DURASI KGB BARU **//
                $kgbs = DB::table('pengajuan_kgbs')->where('pegawais_nip', '=', $nip)->get();
                foreach($kgbs as $kgb){
                    $tmt_baru = $kgb->tmt_baru;

                    DB::table('pegawais')->where('nip', '=', $nip)->update([
                        'tahun_terakhir_kgb' => $tmt_baru
                    ]);
        
                    $now = date('Y-m-d');

                    $start = \Carbon\Carbon::parse($now);
                    $end = \Carbon\Carbon::parse($kgb->tanggal_kgb_baru);
                    $interval = \date_diff($start, $end);

                    $date = $interval->format("%y Tahun, %m Bulan, %d Hari");
                    $days = $interval->days;

                    DB::table('pegawais')->where('nip', '=', $nip)->update([
                        'update_kgb' => $date
                    ]);
        
                    DB::table('kgbs')->where('pegawais_nip', '=', $nip)->update([
                        'durasi_kgb' => $days,
                        'status' => "Segera Ajukan!"
                    ]);
                }
            }elseif($gajis == false){
                $gajis = DB::select("SELECT*FROM gajis WHERE mkg = ($pegawai->mkg + 1) AND golongan = '$pegawai->golongan'");
                foreach ($gajis as $gaji){
                    DB::table('kgbs')->where('pegawais_nip', '=', $nip)->update([
                        'kenaikan_gaji' => $gaji->gaji_pokok
                    ]);

                    $kgbs = DB::table('kgbs')->where('pegawais_nip', '=', $nip)->get();
                    foreach($kgbs as $kgb){
                        DB::table('pegawais')->where('nip', '=', $nip)->update([
                            'gaji_pegawai' => $kgb->kenaikan_gaji,
                            'mkg' => $gaji->mkg,
                            'gajis_id' => $gaji->id
                        ]);
                    }
                }

                //** UPDATE TAHUN TERAKHIR KGB & DURASI KGB BARU **//
                $kgbs = DB::table('pengajuan_kgbs')->where('pegawais_nip', '=', $nip)->get();
                foreach($kgbs as $kgb){
                    $tmt_baru = $kgb->tmt_baru;

                    DB::table('pegawais')->where('nip', '=', $nip)->update([
                        'tahun_terakhir_kgb' => $tmt_baru
                    ]);
        
                    $now = date('Y-m-d');

                    $start = \Carbon\Carbon::parse($now);
                    $end = \Carbon\Carbon::parse($kgb->tanggal_kgb_baru);
                    $interval = \date_diff($start, $end);

                    $date = $interval->format("%y Tahun, %m Bulan, %d Hari");
                    $days = $interval->days;

                    DB::table('pegawais')->where('nip', '=', $nip)->update([
                        'update_kgb' => $date
                    ]);
        
                    DB::table('kgbs')->where('pegawais_nip', '=', $nip)->update([
                        'durasi_kgb' => $days,
                        'status' => "Segeja Ajukan!"
                    ]);
                }
            }else{
                return redirect('kenaikan-gaji/info')->with(['failed' => 'Data kenaikan gaji berkala pegawai gagal diverifikasi!']);
            }  
        }

        // Menghapus record di tabel notifs
        DB::select("DELETE FROM notifs WHERE pegawais_nip = ($nip) AND kategori = 'kgbs'");

        return redirect('kenaikan-gaji/info')->with(['success' => 'Data kenaikan gaji berkala pegawai berhasil diverifikasi!']);
    }
}
