<?php

namespace App\Http\Controllers;

use App\Kgb;
use App\Kpp;
use App\Pegawai;
use App\PengambilanCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use \Carbon\Carbon;


class CutiPegawaiController extends Controller
{
    public function index(){
        $index = DB::table('pegawais')
                ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                ->paginate(10);
        
        $notification = DB::table('notifs')->get();

        return view('pages.cutipegawai.index', ['index' => $index, 'notification' => $notification]);
    }
    
    public function create()
    {
        $create = DB::table('pegawais')
                ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                ->get();
        
        $notification = DB::table('notifs')->get();

        return view('pages.cutipegawai.create', ['create' => $create, 'notification' => $notification]);
    }

    public function store(Request $request){
        /*$this->validate($request,[
            'nip' => 'required|numeric|unique:ajuan_cutis,nip',
            'name' => 'required',
            'tahunambilcuti' => 'required|numeric',
            'tanggalmulai' => 'required',
            'tanggalakhir' => 'required',
        ]);*/

        $tbambilcuti = new PengambilanCuti();
        $tbambilcuti->nip = $request->nip;
        $tbambilcuti->nama = $request->nama;
        $tbambilcuti->tahun_cuti = $request->tahun_cuti;
        $tbambilcuti->tahun_sisa_cuti = $request->sisa_cuti;
        $tbambilcuti->tanggal_mulai_cuti = $request->tanggal_mulai_cuti;
        $tbambilcuti->tanggal_akhir_cuti = $request->tanggal_akhir_cuti;
        
        $n = date('Y');
        $n1 = date('Y', strtotime('-1 year', strtotime($n)));
        $n2 = date('Y', strtotime('-2 year', strtotime($n)));
        $start = \Carbon\Carbon::parse($request->tanggal_mulai_cuti);
        $end = \Carbon\Carbon::parse($request->tanggal_akhir_cuti);

        $interval = \date_diff($start,$end);

        $request->nip = strval($request->nip);
        $get = Pegawai::where('nip','=',$request->nip)->get();
        foreach($get as $pegawais)
        if (($request->tahun_cuti == $n) && ((($pegawais->sisa_tahun_n) - (($interval->days) + 1)) >= 0)) {
            $sisa_cuti = ($pegawais->sisa_tahun_n) - (($interval->days) + 1);
            $pegawais->update([
                'sisa_tahun_n' => $sisa_cuti
        ]);
        }elseif (($request->tahun_cuti == $n1) && ((($pegawais->sisa_tahun_n1) - (($interval->days) + 1)) >= 0)) {
            $sisa_cuti = ($pegawais->sisa_tahun_n1) - (($interval->days) + 1);
            $pegawais->update([
                'sisa_tahun_n1' => $sisa_cuti
            ]);
        }elseif (($request->tahun_cuti == $n2) && ((($pegawais->sisa_tahun_n2) - (($interval->days) + 1)) >= 0)) {
            $sisa_cuti = ($pegawais->sisa_tahun_n2) - (($interval->days) + 1);
            $pegawais->update([
                'sisa_tahun_n2' => $sisa_cuti
            ]);
        }else {
            return back()->with(['failed' => 'Form cuti pegawai gagal tersimpan, sisa cuti pegawai tidak mencukupi!']);
        }

        $tbambilcuti->lama_cuti = ($interval->days + 1);
        $tbambilcuti->save();

        return back()->with(['success' => 'Form cuti pegawai berhasil tersimpan!']);
    }

    public function notif(){
        $notif = DB::table('pengambilan_cutis')->paginate(10);

        $notification = DB::table('notifs')->get();

        return view('pages.cutipegawai.notif', ['notif' => $notif, 'notification' => $notification]);
    }
}